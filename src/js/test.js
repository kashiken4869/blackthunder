// ここからtomoaki
// const user = document.getElementById('user');
// const bench = document.getElementById('bench');
// const home = document.getElementById('home');
// user.addEventListener("click",function(){ //個人のページに飛ぶ
//     window.location.href = './account.php';
// })
// bench.addEventListener("click",function(){ //ベンチページに飛ぶ
//     window.location.href = './bench.php';
// })
// home.addEventListener("click",function(){ //TLページに飛ぶ
//     window.location.href = './index.php';
// })

const profile = document.getElementById('profile');
const closed = document.querySelector('.closed');
const editWrapper = document.querySelector(".edit-wrapper");
editWrapper.addEventListener("click",function(){
    profile.style.display = "block";   
    setTimeout(function(){
        profile.classList.add("soft");
        film.classList.add("blacker");
    },100)
})
closed.addEventListener("click",function(){
    profile.style.display = "none";
    setTimeout(function(){
        profile.classList.remove("soft");
        film.classList.remove("blacker");
    },100)
})
