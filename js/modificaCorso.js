function addLesson() {
    const clonedLesson = $('#lessonTemplate').clone();
    clonedLesson.css({ display: 'block' });
    $('#lezioni').append(clonedLesson);
}
function removeLesson(button) {
    $(button).parent().remove();
}
