function hello(){
    console.log('hello word');
}
if (document.querySelector('#hello')){
    document.querySelector('#hello').addEventListener('click',function(){
        hello();
    });
}