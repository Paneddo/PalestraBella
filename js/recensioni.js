$('.rating').on('click', '.ratings_stars', (e) => {
    let star = $(e.target);
    star.addClass('checked');
    star.prevAll().addClass('checked');
    star.nextAll().removeClass('checked');
    $('#rating').val(star.data('rating'));
});
