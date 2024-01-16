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
    }
  },
});
