

const tabs = document.querySelectorAll('[data-tab-target]');
const tabContents = document.querySelectorAll('.info');
tabs.forEach(tab => {
  tab.addEventListener('click', () => {
    const target = document.querySelector(tab.dataset.tabTarget)
    tabContents.forEach(tabContent => {
      tabContent.className = tabContent.className.replace(" show", "");
    })
    tabs.forEach(tab => {
      tab.className = tab.className.replace(" active", "");
    })
    tab.className += " active";
    target.className += " show";
  });
});
function change(type){
  const boxContents = document.querySelectorAll('.info');
  const boxtarget = document.getElementById(type);
  boxContents.forEach(boxContent => {
    boxContent.className = boxContent.className.replace(" show", "");
  })
  boxtarget.className += " show";
} 

document.querySelector("#login_page").addEventListener('click', function(){
  location.href="login_page.php";
});
