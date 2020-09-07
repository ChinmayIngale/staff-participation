
function isOverflown(element){
  return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
}
const parent = document.querySelector('.img');
// Show if overflowed
if(isOverflown(parent)){
  document.querySelector('.img').className+= " overflow"
}

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