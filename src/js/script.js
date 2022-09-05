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
        if(bench.classList.contains("benchOn")){
            addBenchCount = Number(benchCount) - 1;
        }else{
            addBenchCount = Number(benchCount) + 1;
        }
        count[index].innerHTML = addBenchCount;
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
// //introduction 画像の変更前プレビュー
// document.getElementById("filesend").addEventListener('change', function(e) {
//     var defaultImg = document.getElementById('postHeaderLogo').src;
//     if (e.target.files && e.target.files[0]) {
//         const reader = new FileReader();
//         reader.onload = function(e) {
//             document.getElementById('postHeaderLogo').setAttribute('src', e.target.result);
//         };
//         reader.readAsDataURL(e.target.files[0]);
//     }
//     //保存するではなく、×をクリックしたら変更前の画像に戻す
//     closed.addEventListener("click",function(){
//         document.getElementById('postHeaderLogo').setAttribute('src', defaultImg);
//     })
// })


function get_param(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return false;
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

$(function () {
$(document).on('click', '.bench',function(e){
    e.preventDefault();
    let post_id = $(e.target).data('post');
    console.log(post_id);
    $.ajax({
        type: 'POST',
        url: 'getData.php',
        dataType: 'text',
        data: { post_id: post_id}
    }).done(function(data){
        $(e.target).toggleClass("benchOn");
    }).fail(function() {
        console.log("aaaa")
    });
  });
})

$(function(){
    $("[name='iconImg']").on('change', function (e) {
      
      var reader = new FileReader();
      
      reader.onload = function (e) {
          $("#preview").attr('src', e.target.result);
      }
  
      reader.readAsDataURL(e.target.files[0]);   
  
    });
  });

//   const user = document.getElementById('user');
//   const bench = document.getElementById('bench');
//   const home = document.getElementById('home');
//   user.addEventListener("click",function(){ //個人のページに飛ぶ
//       window.location.href = './account.php';
//   })
//   bench.addEventListener("click",function(){ //ベンチページに飛ぶ
//       window.location.href = './bench.php';
//   })
//   home.addEventListener("click",function(){ //TLページに飛ぶ
//       window.location.href = './index.php';
//   })


const sun = document.querySelector('.sun');
const moon = document.querySelector('.moon');
const posts = document.querySelectorAll('.post');
let mode = localStorage.getItem('mode');
sun.addEventListener("click",function(){
        sun.style.display = 'none';
        moon.style.display = "block"
        // document.body.style.backgroundColor = "2e2b2b";
        document.body.classList.add("darkMode");
        posts.forEach(function(post){
            post.classList.add("darkMode")
    })
})

moon.addEventListener("click",function(){
        moon.style.display = 'none';
        sun.style.display = "block"
        document.body.classList.remove("darkMode");
        posts.forEach(function(post){
            post.classList.remove("darkMode")
    })
})


// if (mode === 'dark') {
//     sun.style.display = 'none';
//     moon.style.display = "block"
//     // document.body.style.backgroundColor = "2e2b2b";
//     document.body.classList.add("darkMode");
//     posts.forEach(function(post){
//         post.classList.add("darkMode")
// })
//   }

//   if (mode === 'normal') {
//     moon.style.display = 'none';
//     sun.style.display = "block"
//     document.body.classList.remove("darkMode");
//     posts.forEach(function(post){
//         post.classList.remove("darkMode")
// })
//   }

// const body = document.querySelector('body');
// const darkmodeBtn = document.getElementById('darkmodeBtn');


// if (mode === 'dark') {
//   body.classList.add('dark');
// }

// darkmodeBtn.addEventListener('click', () => {
//   body.classList.toggle('dark');
//   if (mode === 'normal') {
//     localStorage.setItem('mode', 'dark');
//     mode = 'dark';
//   } else {
//     localStorage.setItem('mode', 'normal');
//     mode = 'normal';
//   }
// });
const benchModal = document.querySelectorAll('.benchModal');
counts.forEach((count) => {
    count.addEventListener('click', () => {
        let number = [...counts].indexOf(count);
        [...benchModal][number].style.display = 'block';
        film.classList.add("blacker");
    })
})

$(".open-btn1").click(function () {
    $(this).toggleClass('btnactive');//.open-btnは、クリックごとにbtnactiveクラスを付与＆除去。1回目のクリック時は付与
    $("#search-wrap").toggleClass('panelactive');//#search-wrapへpanelactiveクラスを付与
  $('#search-text').focus();//テキスト入力のinputにフォーカス
  $('.dm-list').remove();
  $('.post').show();
});


