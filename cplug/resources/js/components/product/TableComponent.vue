<template>
  <div>

    <div class="form-group row">
      <div class="col-md-6">
        <input class="form-control" placeholder="Buscar" type="text" v-model="search" />
      </div>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Image</th>
          <th scope="col">Nome</th>
          <th scope="col">Preço</th>
          <th scope="col">Descrição</th>
          <th scope="col">Cor</th>
          <th scope="col">Tamanho</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in filteredItems" :key="product.id">
          <th scope="row">{{product.id}}</th>
          <td v-if="product.image"><img class="img-product" :src="'../storage/' + product.image" alt=""></td>
          <td v-if="!product.image"></td>
          <td>{{product.name}}</td>
          <td>{{product.price}}</td>
          <td>{{product.description}}</td>
          <td>{{product.color}}</td>
          <td>{{product.size}}</td>
          <td class="flex">
            <button type="button" @click="editProduct(product)" class="btn btn-primary float-left">Edit</button>
            <button v-if="adminProp == 'true'" type="button" @click="removeProduct(product)" class="btn btn-warning float-left">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["products", "admin", "lang"],
  data() {
      console.log(this.lang, this.admin)
    return {
      search: "",
      itens: this.products ? JSON.parse(this.products) : [],
      adminProp: this.admin, 
      langProp: this.lang

    };
  },
  computed: {
    filteredItems() {
      return this.itens.filter(item => {
        return item.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1;
      });
    }
  },
  methods: {
    removeProduct(product) {
      axios.delete('/'+this.lang+'/product/'+product.id, {data: product}).then(response => {
          if(response){
              alert("Produto removido com sucesso")
              location.reload();
          }else{
              alert("Erro ao tentar remover produto")
          }
      }).catch(error => {
        console.log(error)
      });
    },
    editProduct(product) {
      console.log(location.href)
      location.href = location.href + '/' + product.id +'/edit';
    },
  }
};
</script>

<style scoped>
.flex {
  display: flex;
}
</style>