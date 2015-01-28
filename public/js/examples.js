$(document).ready(function() {
var url = 'http://localhost/logintest/'; //this may need to change in the live site
//var selected = [];

var books = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('title'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  limit: 3,
  prefetch: {
    // url points to a json file that contains an array of book names, see
    // https://github.com/twitter/typeahead.js/blob/gh-pages/data/countries.json
    url: url+'books.json',
	ttl: 0, 
    // the json file contains an array of strings, but the Bloodhound
    // suggestion engine expects JavaScript objects so this converts all of
    // those strings
    filter: function(list) {
      return $.map(list, function(book) { 
            return { 
            id: book.id,
            title: book.title,
            author: book.author,
            isbn: book.isbn,
            available:  (book.available == 1) ? '<span class="label label-success">available</span>' : '<span class="label label-warning">unavailable</span>',
            //available: book.available,
            description: book.description || 'description not available'
            }; 
        });
    }
  }
});


// kicks off the loading/processing of `local` and `prefetch`
books.initialize();

// passing in `null` for the `options` arguments will result in the default
// options being used
$('.demo .typeahead').typeahead(null, {
  displayKey: 'title', // displays the name (title) of book/dvd in the search bar
  engine: Handlebars,
  templates: {
    empty: [
      '<div class="empty-message">',
      'no results found',
      '</div>'
    ].join('\n'),
	suggestion: Handlebars.compile(
        //'<img class="typeahead_photo" src="{{image}}"/> \n\
       '<p>{{{available}}}</p> \n\
        <hr>\n\
        <h1><strong>{{title}}</strong></h1>'
        ) // layout of the searchbar results
  },
  engine: Handlebars,
  // `ttAdapter` wraps the suggestion engine in an adapter that
  // is compatible with the typeahead jQuery plugin
  source: books.ttAdapter()
  
});
$('.demo .typeahead').on('typeahead:selected', function (e, datum) {   
     $("#id").val(datum['id']);//set value of the id
     $("#isbn").val(datum['isbn']);//set value of isbn
  });
});