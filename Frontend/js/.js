// Variáveis para armazenar contagem de favoritos e total do carrinho
let favoritesCount = 0;
let cartTotal = 0;

// Função para adicionar um item aos favoritos
function addFavorite() {
    favoritesCount++;
    updateFavoritesCount();
}

// Função para adicionar um item ao carrinho
function addToCart(price) {
    cartTotal += price;
    updateCartTotal();
}

// Função para atualizar a contagem de favoritos no ícone
function updateFavoritesCount() {
    document.getElementById("favorites-count").innerText = favoritesCount;
}

// Função para atualizar o total do carrinho
function updateCartTotal() {
    document.getElementById("cart-price").innerText = `R$${cartTotal.toFixed(2)}`;
}

// Exemplo de uso
// Chame essas funções quando um item for adicionado
addFavorite(); // Para adicionar um favorito
addToCart(); // Para adicionar um item ao carrinho
