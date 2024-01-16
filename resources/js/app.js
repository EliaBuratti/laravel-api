import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])


/* toggle sidebar */
const btnSidebar = document.querySelector('.toggle-sidebar');
const sidebar = document.querySelector('#sidebarMenu');
const content = document.querySelector('#main-content');
const contentPage = document.querySelector('#container-page');

btnSidebar.addEventListener('click', function () {
    sidebar.classList.toggle('active');
    btnSidebar.classList.toggle('text-black');
    btnSidebar.classList.toggle('eb_rotate');
    content.classList.toggle('col-lg-12');
    content.classList.toggle('col-md-12');
    contentPage.classList.toggle('row');
})

