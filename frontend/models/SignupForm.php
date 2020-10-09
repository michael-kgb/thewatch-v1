<?php

namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $id;
    public $username;
    public $email;
    public $password;
    public $fullname;
    public $profile_photo;
    public $group_id;
	public $store_id;
    public $departement_id;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['fullname', 'string'],
            ['profile_photo', 'string'],
            ['departement_id', 'integer'],
            ['group_id', 'integer'],
			['store_id', 'integer'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
//        if ($this->validate()) {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->fullname = $this->fullname;
        // $user->profile_photo = $this->profile_photo;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user = new User();
        $user->username = $this->username;
		$user->store_id = $this->store_id;
        $user->email = $this->email;
        $user->fullname = $this->fullname;
        $user->group_id = $this->group_id;
        $user->profile_photo = "";
        $user->departements_departement_id = $this->departement_id;
        $user->status = 10;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if ($user->save()) {

            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'create';
            $log->id_onChanged = $user->id;

            $log->save();

            return $user;
        }
//        }
//        return null;
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function reset($id) {
//        if ($this->validate()) {
        $user = User::findOne($id);
        
        $user->setPassword($user->username . '123');
        $user->generateAuthKey();
        
        if ($user->save()) {

            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'reset password';
            $log->id_onChanged = $user->id;

            $log->save();

            return $user;
        }
//        }
//        return null;
    }

}
