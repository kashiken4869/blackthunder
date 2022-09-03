const create = document.querySelector(".create");
const modal = document.querySelector(".modal");
const film = document.querySelector(".blackFilm");
const close = document.querySelector(".close");
const benches = document.querySelectorAll(".bench");
const counts = document.querySelectorAll(".count");


create.addEventListener("click",function(){
    modal.style.display = "block";
    setTimeout(function(){
        modal.classList.add("soft");
        film.classList.add("blacker");
    },100)
}) 

close.addEventListener("click",function(){
    modal.style.display = "none";
    setTimeout(function(){
        modal.classList.remove("soft");
        film.classList.remove("blacker");
    },100)
})

benches.forEach(function(bench){
    bench.addEventListener("click",function(e){
        // let benchHtml = [].slice.call( benches ) ;
        let index = [...benches].indexOf(bench);
        let count = [...counts];
        benchCount = count[index].innerHTML;
        if(bench.firstElementChild.classList.contains("benchOn")){
            addBenchCount = Number(benchCount) - 1;
        }else{
            addBenchCount = Number(benchCount) + 1;
        }
        count[index].innerHTML = addBenchCount;
        bench.firstElementChild.classList.toggle("benchOn");
    })
})



// create.addEventListener("click",function(){
//     modals[1].classList.add("hide");
//     modals[1].classList.add("soft");
//     film.classList.add("blacker");
// })

// const closes = document.querySelectorAll(".close");
// closes[1].addEventListener("click",function(){
//     modals[1].classList.remove("soft");
//     modals[1].classList.remove("hide");
//     film.classList.remove("blacker");
// })


// ここからtomoaki
const user = document.getElementById('user');
const bench = document.getElementById('bench');
const home = document.getElementById('home');
user.addEventListener("click",function(){ //個人のページに飛ぶ
    window.location.href = './account.php';
})
bench.addEventListener("click",function(){ //ベンチページに飛ぶ
    window.location.href = './bench.php';
})
home.addEventListener("click",function(){ //TLページに飛ぶ
    window.location.href = './index.php';
})

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
//introduction 画像の変更前プレビュー
document.getElementById("filesend").addEventListener('change', function(e) {
    var defaultImg = document.getElementById('postHeaderLogo').src;
    if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('postHeaderLogo').setAttribute('src', e.target.result);
        };
        reader.readAsDataURL(e.target.files[0]);
    }
    //保存するではなく、×をクリックしたら変更前の画像に戻す
    closed.addEventListener("click",function(){
        document.getElementById('postHeaderLogo').setAttribute('src', defaultImg);
    })
})


