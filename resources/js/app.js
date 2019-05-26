/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function() {
    let counter=2;
    $('.add-answer').on('click',function () {

        $('.prepend-btn').before('<div class="form-group">\n' +
            '    <label for="answer'+counter+'">Answer:</label>\n' +
            '    <input class="form-control" name="answers[]" type="text" id="answer'+counter+'">\n' +
            '</div>')
        counter++;
    })
});