function addLesson() {
    const clonedLesson = $('#lessonTemplate').clone();
    clonedLesson.removeAttr('style');
    $('#lezioni').append(clonedLesson);
}
function removeLesson(button) {
    $(button).parent().remove();
}
