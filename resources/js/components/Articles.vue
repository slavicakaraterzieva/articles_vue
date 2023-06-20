<template>

<div>
        
        <h1 class="mb-5 text-light">My Articles</h1>
        
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">

                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.prev_page_url)">Previous</a></li>

                <li class="page-item disabled"><a class="page-link text-dark" href="#">Page{{pagination.current_page}} of {{ pagination.last_page }}</a></li>

                <li v-bind:class="[{disabled: !pagination.next_page_url}]"  class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.next_page_url)">Next</a></li>

            </ul>
        </nav>

<div class="row">
    <form class=" md-5" @submit.prevent="addArticle">
    <!--      {{csrf_field()}}
    {{method_field('PUT')}} --> 
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Title" v-model="article.title">
            </div>

            <div class="form-group">
                <textarea class="form-control" placeholder="Body" v-model="article.description"></textarea>
            </div>
           
            <button type="submit" class="btn btn-secondary" style="width:100%">Save</button>
           
        </form>
</div>
        <div class="card-group p-2 mb-5 mt-5">
           <div class="d-flex">
            <div class="card m-2" style="width:50%" v-for="article in articles">
                   
                <div class="card-body">
                   <h5 class="card-title text-secondary">{{article.title}}</h5>
                   <p class="card-text">{{ article.description }}</p>
                   </div>
                            <div class="card-footer">
                            <small class="text-muted p-3"><button class="btn btn-secondary mb-3 mt-3" @click="editArticle(article)">Edit</button></small>
                           
                            <small class="text-muted p-3"><button class="btn btn-secondary mb-3 mt-3" @click="deleteArticle(article.id)">Delete</button></small>
                            </div>
               </div>
           </div>
                   
        </div>
           
    </div>

</template>

<script>
export default{
    data(){
        return{
            articles:[],
            article:{
                id:'',
                title:'',
                description:''
            },
            article_id:'',
            pagination:{},
            edit:false
        }
    },
    created(){
        this.fetchArticles();
    },
    methods:{
        fetchArticles(page_url){
            let vm=this;
            page_url=page_url  || '/api/articles'
            fetch(page_url)
            .then(res=>res.json())
            .then(res=>{
                this.articles=res.data;
                vm.makePagination(res.meta, res.links);
            })
            .catch(err=>console.log(err));
        },
        makePagination(meta, links){
            let pagination={
                current_page:meta.current_page,
                last_page:meta.last_page,
                next_page_url:links.next,
                prev_page_url:links.prev

            }
            this.pagination=pagination;
        },
        deleteArticle(id){
          if(confirm('Are You Sure?')){
            fetch(`/api/article/${id}`,{

                method: 'delete'
          })
          .then(res=>res.json())
          .then(data=>{
            alert('Article Removed');
            this.fetchArticles();
          })
         
           }
        },

        addArticle(){
            if(this.edit===false){
                //add
                fetch('/api/article',{
                    method:'post',
                    body: JSON.stringify(this.article),
                    headers:{
                        'content-type':'application/json'
                    }
                })
                .then(res=>res.json())
                .then(data=>{
                this.clearForm();
                alert("Article Added");
                this.fetchArticles();
            })
            .catch(err=>console.log(err))
            }
             else{
                //update
                fetch('/api/article',{
                    method:'put',
                    body: JSON.stringify(this.article),
                    headers:{
                        'content-type':'application/json'
                    }
                })
                .then(res=>res.json())
                .then(data=>{
                this.clearForm();
                alert("Article Updated");
                this.fetchArticles();
            })
             .catch(err=>console.log(err))
            } 
        },
        editArticle(article){
            this.edit=true;
            this.article.id=article.id;
            this.article.article_id=article.id;
            this.article.title=article.title;
            this.article.description=article.description;

        },
        clearForm() {
      this.edit = false;
      this.article.id = null;
      this.article.article_id = null;
      this.article.title = '';
      this.article.description = '';
    }
    }
}
</script>