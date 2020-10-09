new Vue({
    el: '#app', 
    data () {
      var dataItem = new Object();
      dataItem = {
          //imageURL: "//thewatch.imgix.net/product/",
          products: null
      };
      return {
        dataItem: dataItem
      }
    },
    mounted () {
      axios.post('https://gostaging.thewatch.co/go-api/products/get-category?page=1&limit=150&sortby=brand', {
        page: 1,
        limit: 150,
        sortby: 'brand'
      }).then(response => {
        this.dataItem.products = response['data']['result']
      })
      .catch((e) => {
        console.log(e)
      })
      
    }
  });

  
Vue.component('product-component', {
template: `


<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 product">
<div class="card" style="width: 18rem;" id="product-{{product.product_id}}">
    <input type="hidden" class="price" name="price" value="1790000">
    <input type="hidden" class="weight" name="weight" value="500">
    <input type="hidden" name="productPrice" value="1790000">
    <img v-bind:src="'https://thewatch.imgix.net/product/'+ product.product_id+'/'+ product.product_id+'.jpg?auto=compress%2Cformat&fit=max&fm=pjpg&w=1400'" class="card-img-top" alt="Card image cap">
    <div class="card-body">
    <div class="product brand-title">OLIVIA BURTON</div>
    <div class="product product-name"><span class="lspace0-5">{{product.name}}</span></div>
    <div class="product-detail product-price">IDR {{product.price}}</div>
    <div class="product-detail product-installment" style="text-align: left;">IDR IDR 149.167 / bulan</div>
    </div>
</div>
</div>
`,
props: {
product: Object 
}
});