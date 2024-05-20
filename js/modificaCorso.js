function addLesson() {
    const clonedLesson = $('#lessonTemplate .lezione').clone();
    console.log(clonedLesson[0]);
    clonedLesson.removeAttr('style');
    $('#lezioni').append(clonedLesson);
}
function removeLesson(button) {
    $(button).parent().remove();
}
