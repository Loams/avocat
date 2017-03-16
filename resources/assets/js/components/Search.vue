<template>
    <div class="search_component">
       <div class="col-md-9">
                <input type="text" 
                v-model="search_query" 
                class="search-input" 
                @keyup="ExecuteSearch" 
                placeholder="article titre date  "
               >
        </div>
        <div class="col-md-9">
            <ul class="search_results">
                <li class="single_search_result" v-for="article in articles">
                 <a :href="'article/'+article.id">
                <span class="article_title">{{ article.titre }} </span>
                <em>
                {{ article.description}}
                {{ article.joid}}
                {{ article.nature}}
                {{ article.type}}
                </em>
                 </a>  
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                search_query : '',
                articles : '',
                showResults : false,
            }
        },
        methods : {
            ExecuteSearch : function () {
                 var VueInstance = this;
                    console.log(VueInstance.search_query == "");
                    if(!VueInstance.search_query == ""){
                  axios.post('executeSearch', {
                        search_query: VueInstance.search_query

                    })
                        .then(function (response) {

                         VueInstance.articles = response.data.articles;
                        })
                        .catch(function (error) {
                        });
                }else{
                    VueInstance.articles
                }
            }
        }
    }
</script>
<style>
    .search_component{
        display:flex;
        flex-direction: column;
        width: 100%;
        justify-content: center;
        align-items: center;
    }
    .search_component input {
        border : 1px transparent;
    }
    .search_results {
        list-style-type: none;
        background:lightgrey;
        padding-left: 0px;
        margin-top: 5px;
        position:absolute;
        z-index: 999;
    }
    .single_search_result {
          border-bottom: 2px solid #eeeeee;
          padding:10px;
    }
    .single_search_result:hover {
        background: #cccccc;
        cursor : pointer;
    }
    .article_name {
        font-weight: bolder;
    }
</style>