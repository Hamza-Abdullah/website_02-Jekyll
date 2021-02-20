const tabItems = document.querySelectorAll(".tab-item");
const tabContentItems = document.querySelectorAll(".tab-content-item");
const backgroundNum = Math.round(Math.random() * 10) + 1;

// Select tab
function selectItem(e) {
    removeBorder();
    removeShow();
    // Add border to clicked tab
    this.classList.add("tab-border");
    // Get content items
    const tabContentItem = document.querySelector(`#${this.id}-content`);
    // Add show class
    tabContentItem.classList.add("show");
}

function removeBorder() {
    tabItems.forEach((item) => item.classList.remove("tab-border"));
}

function removeShow() {
    tabContentItems.forEach((item) => item.classList.remove("show"));
}

// Listen for click
tabItems.forEach((item) => item.addEventListener("click", selectItem));

// Randomly select background image
document.getElementById(
    "showcase"
).style.backgroundImage = `url('https://hamza-abdullah.herokuapp.com/filmsalesservice/images/background${backgroundNum}.jpg')`;
