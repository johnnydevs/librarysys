<script>
$(document).ready(function() {    
var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substrRegex;
 
    // an array that will be populated with substring matches
    matches = [];
 
    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');
 
    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        // the typeahead jQuery plugin expects suggestions to a
        // JavaScript object, refer to typeahead docs for more info
        matches.push({ value: str });
      }
    });
 
    cb(matches);
  };
};
 
var category = ['Childrens', 'Adult', 'Teenager', 'Horror', 'Crime', 'Colouring',
                'Music', 'Educational', 'Fantasy'
];
 
$('#category .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'category',
  displayKey: 'value',
  source: substringMatcher(category)
});   
});
</script>
<script>
$(document).ready(function() {     
var url = 'http://localhost/logintest/';    
var books = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('author'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  limit: 10,
  prefetch: {
    // url points to a json file that contains an array of country names, see
    // https://github.com/twitter/typeahead.js/blob/gh-pages/data/countries.json
    url: url+'books.json',
    // the json file contains an array of strings, but the Bloodhound
    // suggestion engine expects JavaScript objects so this converts all of
    // those strings
    filter: function(list) {
      return $.map(list, function(book) { 
            return { 
            author: book.author
            }; 
        });
    }
  }
});
 
// kicks off the loading/processing of `local` and `prefetch`
books.initialize();
 
// passing in `null` for the `options` arguments will result in the default
// options being used
$('#prefetch .typeahead').typeahead(null, {
  displayKey: 'author',
  // `ttAdapter` wraps the suggestion engine in an adapter that
  // is compatible with the typeahead jQuery plugin
  source: books.ttAdapter()
});   
}); 
</script>


<style>
.tt-input {
  width: 100%;
  font-size: 18px !important;
  color: #555 !important;
}    
</style>

<div class="container">
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
    <div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
      <form method="post" action="<?php echo URL;?>admin/create">
        <h1>Add Book</h1>
        <hr class="colorgraph">
        <div class="row">
          <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
              <input type="text" name="title" id="title" class="form-control input-lg" placeholder="title" tabindex="1">
            </div>
          </div>
          <div id="category" class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
              <input type="text" name="category" class="form-control input-lg typeahead" placeholder="category" tabindex="2">
            </div>
          </div>
        </div>
        <div id="prefetch" class="form-group">
          <input type="text" name="author" id="author" class="form-control input-lg typeahead" placeholder="author" tabindex="3">
        </div>
        <div class="form-group">
          <input type="text" name="subtitle" id="subtitle" class="form-control input-lg" placeholder="subtitle" tabindex="3">
        </div>
        <div class="form-group">
          <input type="text" name="isbn" id="ISBN" class="form-control input-lg" placeholder="ISBN" tabindex="4">
        </div>
        <div class="row">
          <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
              <input type="text" name="year" id="password" class="form-control input-lg" placeholder="year" tabindex="5">
            </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
              <input type="text" name="pageCount" id="pageCount" class="form-control input-lg" placeholder="page count" tabindex="6">
            </div>
          </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <textarea type="text" name="description" id="description" class="form-control input-lg" placeholder="description" tabindex="6"></textarea>
            </div>
          </div>
        </div>

        <hr class="colorgraph">
        <div class="row">
          <div class="col-xs-6 col-md-6">
              <input type="submit" value="Add book to library" class="btn btn-info" autocomplete="off" />
          </div>
        </div>
      </form>
    </div>
    
</div>
