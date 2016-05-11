window.onload = function (){
    var viewMore = document.getElementById('frontcourseView');
    viewMore.addEventListener('click', function (){
        var courseContainer = document.querySelector('.courses.frontpage-course-list-all .row-fluid');
        if(courseContainer != null){
            courseContainer.classList.toggle('show-row-fluid');
            if(courseContainer.classList.contains('show-row-fluid')){
                viewMore.innerHTML = "View Less";
            }else {
                viewMore.innerHTML = "View More";
            }
        }else {
            alert('course container is null');
        }
    });
}