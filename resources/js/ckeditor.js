import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

document.addEventListener('DOMContentLoaded', () => {
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
});
