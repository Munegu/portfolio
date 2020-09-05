import '../scss/app.scss';
import $ from 'jquery';
import 'popper.js';
import 'bootstrap';

$("body").on("click", ".collection-add", e => {
    let collection = $(`#${e.currentTarget.dataset.collection}`);
    let prototype = collection.data('prototype');
    let index = collection.data('index');

    collection.append(prototype.replace(/__name__/g, index));
    collection.data('index', index++);
})

