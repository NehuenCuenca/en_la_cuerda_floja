export const useCartStore = defineStore("cart", {
  state: () => ({
    productsInCart: [
      // {
      //   id: 'abc',
      //   name: "Flauta melodica shurer 500 gb rigida boquilla",
      //   price_cost: 999.99,
      //   quantity: 1,
      // },
    ],
  }),
  getters: {
    allProducts: (state) => state.productsInCart,
  },
  actions: {
    addToCart( newProduct ) {  
      const alreadyInCart = this.productsInCart.find(({id}) => newProduct.id === id)
      
      if(alreadyInCart){
        alreadyInCart.quantity = alreadyInCart.quantity + newProduct.quantity;
        return
      }

      this.productsInCart.push(newProduct)
    },
    removeFromCart( idToRemove ) {  
        const cartUpdated = this.productsInCart.filter( ({ id }) => id != idToRemove)
        this.productsInCart = [ ...cartUpdated ]
    },
    
    handleQuantity (id, action) { 
      const productToUpdate = this.productsInCart.find( product => product.id === id)

      switch (action) {
        case 'add':
          productToUpdate.quantity++; 
          break;
        case 'remove':
          if(productToUpdate.quantity > 1)
          productToUpdate.quantity--; 
          break;
      }
    },

    async generateOrder() {
      const token = localStorage.getItem('en_la_cuerda_floja_token')
      const { data, error, refresh } = await useFetch("http://127.0.0.1:8000/api/orders", {
        method: "POST",
        body: JSON.stringify({
          cart: this.allProducts
        }),
        headers: {
          'Authorization': `Bearer ${token}`,
          'Accept': "application/json",
        },
      });

      if(error.value){
        alert("Error: " + error.value.data.message);
        return
      }
      
      const { init_point } = data.value
      window.open(init_point, 'blank')
    },
  },
});
