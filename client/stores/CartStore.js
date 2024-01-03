export const useCartStore = defineStore("cart", {
  state: () => ({
    productsInCart: [
      {
        id: 'abc',
        name: "Flauta melodica shurer 500 gb rigida boquilla",
        price_cost: 999.99,
        quantity: 1,
      },
      {
        id: 'xyz',
        name: "Microfono de mano squire inalambrico metal",
        price_cost: 999.99,
        quantity: 3,
      },
    ],
  }),
  getters: {
    allProducts: (state) => state.productsInCart,
  },
  actions: {
    addToCart( newProduct ) {  
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
