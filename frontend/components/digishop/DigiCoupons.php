<?php

namespace app\components\digishop;

use Yii;
use yii\base\Component;

class DigiCoupons extends Component 
{
	/**
	 * These are the regular expression rules that we use to validate the coupon ID, coupon code and coupon name
	 * alpha-numeric, dashes, underscores, or periods
	 *
	 * @var string
	 */
    public $coupon_id_rules = '\.0-9';
    
	/**
	 * These are the regular expression rules that we use to validate the coupon ID, coupon code and coupon name
	 * alpha-numeric, dashes, underscores, or periods
	 *
	 * @var string
	 */
	public $coupon_code_rules = '\.a-zA-Z0-9';

	/**
	 * These are the regular expression rules that we use to validate the coupon ID, coupon code and coupon name
	 * alpha-numeric, dashes, underscores, colons or periods
	 *
	 * @var string
	 */
	public $coupon_name_rules = '\w \-\.\:';

	/**
	 * only allow safe coupon names
	 *
	 * @var bool
	 */
    public $coupon_name_safe = TRUE;
    
	/**
	 * Contents of the coupon
	 *
	 * @var array
	 */
	protected $_coupon_contents = array();
	protected $_cart_contents = array();
 
    public function init(){
        parent::init();
        $session = Yii::$app->session;
        // Grab the coupon array from the session table
        $this->_coupon_contents = $session['coupon_contents'];
        $this->_cart_contents = $session['cart_contents'];

        if ($this->_coupon_contents === NULL)
        {
            // No coupon exists so we'll set some base values
            $this->_coupon_contents = array(
				'total_coupons' => 0,
			);
        }
    }

	// --------------------------------------------------------------------

	/**
	 * Insert items into the coupon and save it to the session table
	 *
	 * @param	array
	 * @return	bool
	 */
	public function insert($items = array())
	{
		// Was any coupon data passed? No? Bah...
		if ( ! is_array($items) OR count($items) === 0)
		{
			Yii::error('error', 'The insert method must be passed an array containing data.');
			return FALSE;
		}

		// You can either insert a single coupon using a one-dimensional array,
		// or multiple coupons using a multi-dimensional one. The way we
		// determine the array type is by looking for a required array key named "id"
		// at the top level. If it's not found, we will assume it's a multi-dimensional array.

		$save_coupon = FALSE;
		if (isset($items['id']))
		{
			if (($rowid = $this->_insert($items)))
			{
				$save_coupon = TRUE;
			}
		}
		else
		{
			foreach ($items as $val)
			{
				if (is_array($val) && isset($val['id']))
				{
					if ($this->_insert($val))
					{
						$save_coupon = TRUE;
					}
				}
			}
		}

		// Save the coupon data if the insert was successful
		if ($save_coupon === TRUE)
		{
			$this->_save_coupon();
			return isset($rowid) ? $rowid : TRUE;
		}

		return FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Insert
	 *
	 * @param	array
	 * @return	bool
	 */
	protected function _insert($items = array())
	{
		// Was any coupon data passed? No? Bah...
		if ( ! is_array($items) OR count($items) === 0)
		{
			Yii::error('error', 'The insert method must be passed an array containing data.');
			return FALSE;
		}

		// --------------------------------------------------------------------

		// Does the $items array contain an id, code, name, and type?  These are required
		if ( ! isset($items['id'], $items['code'], $items['name'], $items['type'], $items['amount']))
		{
			Yii::error('error', 'The coupon array must contain a coupon ID, code, name, type, and amount.');
			return FALSE;
		}

		// --------------------------------------------------------------------

		// Validate the coupon ID. It can only be numeric
		// Not totally sure we should impose this rule, but it seems prudent to standardize IDs.
		// Note: These can be user-specified by setting the $this->coupon_id_rules variable.
		if ( ! preg_match('/^['.$this->coupon_id_rules.']+$/i', $items['id']))
		{
			Yii::error('error', 'Invalid coupon ID.  The coupon ID can only contain numeric');
			return FALSE;
		}

		// --------------------------------------------------------------------

		// Validate the coupon code. It can only be alpha-numeric.
		// Note: These can be user-specified by setting the $this->coupon_code_rules variable.
		if ( ! preg_match('/^['.$this->coupon_code_rules.']+$/i', $items['code']))
		{
			Yii::error('error', 'An invalid name was submitted as the coupon code: '.$items['code'].' The code can only contain alpha-numeric');
			return FALSE;
		}

		// --------------------------------------------------------------------

		// Validate the coupon name. It can only be alpha-numeric, dashes, underscores, colons or periods.
		// Note: These can be user-specified by setting the $this->coupon_name_rules variable.
		if ($this->coupon_name_safe && ! preg_match('/^['.$this->coupon_name_rules.']+$/i', $items['name']))
		{
			Yii::error('error', 'An invalid name was submitted as the coupon name: '.$items['name'].' The name can only contain alpha-numeric characters, dashes, underscores, colons, and spaces');
			return FALSE;
		}

		// --------------------------------------------------------------------

		// Prep the amount. Remove leading zeros and anything that isn't a number or decimal point.
		$items['amount'] = (int) $items['amount'];

		// We now need to create a unique identifier for the item being inserted into the coupon.
		// Every time something is added to the coupon it is stored in the master coupon array.
		// Each row in the coupon array, however, must have a unique index that identifies not only
		// a particular coupon, but makes it possible to store identical coupons with different options.
		// For example, what if someone buys two identical t-shirts (same coupon ID), but in
		// different sizes?  The coupon ID (and other attributes, like the name) will be identical for
		// both sizes because it's the same shirt. The only difference will be the size.
		// Internally, we need to treat identical submissions, but with different options, as a unique coupon.
		// Our solution is to convert the options array to a string and MD5 it along with the coupon ID.
		// This becomes the unique "row ID"
		if (isset($items['options']) && count($items['options']) > 0)
		{
			$rowid = md5($items['id'].serialize($items['options']));
		}
		else
		{
			// No options were submitted so we simply MD5 the coupon ID.
			// Technically, we don't need to MD5 the ID in this case, but it makes
			// sense to standardize the format of array indexes for both conditions
			$rowid = md5($items['id']);
		}

		// --------------------------------------------------------------------

		// Now that we have our unique "row ID", we'll add our coupon items to the master array
		// grab amount if it's already there and add it on
		$old_amount = isset($this->_coupon_contents[$rowid]['amount']) ? (int) $this->_coupon_contents[$rowid]['amount'] : 0;

		// Re-create the entry, just to make sure our index contains only the data from this submission
		$items['rowid'] = $rowid;
		$items['amount'] += $old_amount;
		$this->_coupon_contents[$rowid] = $items;

		return $rowid;
    }

    // --------------------------------------------------------------------
    
	/**
	 * Update the coupon
	 *
	 * This function permits the quantity of a given item to be changed.
	 * Typically it is called from the "view coupon" page if a user makes
	 * changes to the quantity before checkout. That array must contain the
	 * product ID and quantity for each item.
	 *
	 * @param	array
	 * @return	bool
	 */
	public function update($items = array())
	{
		// Was any coupon data passed?
		if ( ! is_array($items) OR count($items) === 0)
		{
			return FALSE;
		}

		// You can either update a single product using a one-dimensional array,
		// or multiple products using a multi-dimensional one.  The way we
		// determine the array type is by looking for a required array key named "rowid".
		// If it's not found we assume it's a multi-dimensional array
		$save_coupon = FALSE;
		if (isset($items['rowid']))
		{
			if ($this->_update($items) === TRUE)
			{
				$save_coupon = TRUE;
			}
		}
		else
		{
			foreach ($items as $val)
			{
				if (is_array($val) && isset($val['rowid']))
				{
					if ($this->_update($val) === TRUE)
					{
						$save_coupon = TRUE;
					}
				}
			}
		}

		// Save the coupon data if the insert was successful
		if ($save_coupon === TRUE)
		{
			$this->_save_coupon();
			return TRUE;
		}

		return FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Update the coupon
	 *
	 * This function permits changing item properties.
	 * Typically it is called from the "view coupon" page if a user makes
	 * changes to the quantity before checkout. That array must contain the
	 * rowid and quantity for each item.
	 *
	 * @param	array
	 * @return	bool
	 */
	protected function _update($items = array())
	{
		// Without these array indexes there is nothing we can do
		if ( ! isset($items['rowid'], $this->_coupon_contents[$items['rowid']]))
		{
			return FALSE;
		}

		// find updatable keys
		$keys = array_intersect(array_keys($this->_coupon_contents[$items['rowid']]), array_keys($items));
		// if an amount was passed, make sure it contains valid data
		if (isset($items['amount']))
		{
			$items['amount'] = Yii::$app->params['digishop.rules']['is_decimal_price'] === true ? (float) $items['amount'] : (int) $items['amount'];
		}

		// product id & name shouldn't be changed
		foreach (array_diff($keys, array('id', 'name')) as $key)
		{
			$this->_coupon_contents[$items['rowid']][$key] = $items[$key];
		}

		return TRUE;
    }

	// --------------------------------------------------------------------

	/**
	 * Save the cart array to the session DB
	 *
	 * @return	bool
	 */
	protected function _save_coupon()
	{
		$session = Yii::$app->session;
		
		// Unset these so our total can be calculated correctly below
		unset($this->_coupon_contents['total_coupons']);

		// Lets add up the individual prices and set the cart sub-total
		$items = 0;
		$total = 0;
		$total_discount = 0;

		// Let's add up the individual prices and set the cart sub-total
		$this->_coupon_contents['total_coupons'] = (int) $items;

		foreach ($this->_coupon_contents as $key => $val)
		{
			// We make sure the array contains the proper indexes
			if ( ! is_array($val) OR ! isset($val['code'], $val['amount']))
			{
				continue;
			}

			// Get options Array
			$options = array();

			if ( !empty($val['options']) )
			{
                $options = $val['options'];
                
			} else {
				continue;
			}

			$amount = $val['amount'];
		}

		// Set the total coupon.
	   $this->_coupon_contents['total_coupons'] = count($this->contents());

		// Is our cart empty? If so we delete it from the session
		if (count($this->_coupon_contents) <= 2)
		{
            unset($session['coupon_contents']);

			// Nothing more to do... coffee time!
			return FALSE;
		}

		// If we made it this far it means that our cart has data.
        // Let's pass it to the Session class so it can be stored
        // $this->CI->session->set_userdata(array('cart_contents' => $this->_cart_contents));
        // $cart_contents = array('cart_contents' => $this->_cart_contents);
        $coupon_contents = $this->_coupon_contents;
        $session['coupon_contents'] = $coupon_contents;

		// Woot!
		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Cart Total
	 *
	 * @return	int
	 */
	public function total()
	{
		return $this->_coupon_contents['coupon_total'];
	}

	// --------------------------------------------------------------------

	/**
	 * Remove Item
	 *
	 * Removes an item from the cart
	 *
	 * @param	int
	 * @return	bool
	 */
	 public function remove($rowid)
	 {
		// unset & save
		unset($this->_coupon_contents[$rowid]);
		$this->_save_coupon();
		return TRUE;
	 }

	// --------------------------------------------------------------------

	/**
	 * Total Items
	 *
	 * Returns the total item count
	 *
	 * @return	int
	 */
	public function total_coupons()
	{
		return $this->_coupon_contents['total_coupons'];
	}

	// --------------------------------------------------------------------

	/**
	 * Cart Contents
	 *
	 * Returns the entire cart array
	 *
	 * @param	bool
	 * @return	array
	 */
	public function contents($newest_first = FALSE)
	{
		// do we want the newest first?
		$coupons = ($newest_first) ? array_reverse($this->_coupon_contents) : $this->_coupon_contents;

		// Remove these so they don't create a problem when showing the coupons table
		unset($coupons['total_coupons']);

		return $coupons;
	}

	// --------------------------------------------------------------------

	/**
	 * Get cart item
	 *
	 * Returns the details of a specific item in the cart
	 *
	 * @param	string	$row_id
	 * @return	array
	 */
	public function get_item($row_id)
	{
		return (in_array($row_id, array('total_coupons'), TRUE) OR ! isset($this->_coupon_contents[$row_id]))
			? FALSE
			: $this->_coupon_contents[$row_id];
	}

	// --------------------------------------------------------------------

	/**
	 * Has options
	 *
	 * Returns TRUE if the rowid passed to this function correlates to an item
	 * that has options associated with it.
	 *
	 * @param	string	$row_id = ''
	 * @return	bool
	 */
	public function has_options($row_id = '')
	{
		return (isset($this->_coupon_contents[$row_id]['options']) && count($this->_coupon_contents[$row_id]['options']) !== 0);
	}

	// --------------------------------------------------------------------

	/**
	 * Product options
	 *
	 * Returns the an array of options, for a particular product row ID
	 *
	 * @param	string	$row_id = ''
	 * @return	array
	 */
	public function product_options($row_id = '')
	{
		return isset($this->_coupon_contents[$row_id]['options']) ? $this->_coupon_contents[$row_id]['options'] : array();
	}

	// --------------------------------------------------------------------

	/**
	 * Format Number
	 *
	 * Returns the supplied number with commas and a decimal point.
	 *
	 * @param	float
	 * @return	string
	 */
	public function format_number($n = '')
	{
		return ($n === '') ? '' : number_format( (float) $n, 2, '.', ',');
	}

	// --------------------------------------------------------------------

	/**
	 * Destroy the cart
	 *
	 * Empties the cart and kills the session
	 *
	 * @return	void
	 */
	public function destroy()
	{
        $session = Yii::$app->session;
		$this->_coupon_contents = array(
			'total_coupons' => 0,
		);
        unset($session['coupon_contents']);
	}
    
}