@extends('layout')

@section('gamecon')

  <div class="container">
  
  <div class="col-md-8 col-md-ofset-1">
    <div class="user-detail">
      <h3>Welcome {{Auth::user()->first_name}}</h3>
    </div>
    </div> 
   <div class="col-md-3">  
     <h4>Total Score :{{Auth::user()->score}}</h4>
     <h4 class = "newscore"></h4>
    </div>
     
    
    <div class="col-md-8 col-md-offset-2">
    <div class="block-text">
       <h1 class = "arrtext"></h1>
       
       </div>
    <div class="chosenword-block">
       <h1 class = "chosenword">

       </h1>
     </div>
     <div class="text-block"> 
      
       <div class="text-body">
          <h1>{{$text->text}}</h1> <br>
          <button class="btn btn-primary" id = "generate-btn">Generate</button>
       </div>
       


       <?php 
          $arrnums = array();
          
          for($i=0;$i<count($arrword);$i++) {
                $numran = rand(0,sizeof($arrword)-1); 
          while(in_array($numran,$arrnums)) {
            $numran = rand(0,(count($arrword)-1));
          }
          $arrnums[$i] =$numran; 
          
        } 
       ?>   
       <div class="genword-block">
        <h2 class = "generated-word">  
          <div class="textspan">
       @for($j=0;$j<count($arrword);$j++)
      <span> {{$arrword[$arrnums[$j]]}} </span>
       @endfor
       </div>
      </h2> 
      <div class="buttons">
      <button class="btn btn-warning" id = "addbtn" >Add</button>
      <button class="btn btn-success" id = "checkword" >Check</button>
      <a href="/game/{{$text->id + 1}}" id = "nextbtn">Next Question >>></a>
      </div>
      </div>
       </div>  
    </div>
  </div>
  @endsection
 

@section('gamescript')
<script>
var count=0;
var pagenum = 0;
var arrayy = [];
var arrayy2 = [];
var status = '';
var words
var score;

 @for($k=0;$k<count($arrword);$k++)
   arrayy2.push('<?php echo $arrword[$k]; ?>' );
   
  @endfor
var index = 0;
$('.generated-word').find('span').click(function(event) {  
  console.log(event.target.textContent);
  var worditem = event.target.textContent;
  var word1 = worditem.charCodeAt (0);
  var word2 = arrayy2[index].charCodeAt (0);
  arrayy.push(worditem);

  if(index < arrayy2.length) {
    document.getElementsByClassName('chosenword')[0].innerHTML += arrayy[index];
  }
index++;
event.currentTarget.style.borderColor = 'yellow'; 
});

$('.chosenword').click(function(event) {
  document.getElementsByClassName('chosenword')[0].innerHTML -= worditem;
  document.getElementsByClassName('chosenword')[0].style.borderColor = 'yellow';
   arrayy.pop();
});


$('#generate-btn').click(function(event) {
   $('.text-body').animate({height:"toggle"},500);

     setTimeout(function(){
        $('.genword-block').css('display','block');
     },600);
     
});

var rannum = Math.floor(Math.random()*11);
  $(document).ready(function() {
      $('#checkword').click(function(e) {
        for(var s=0;s<arrayy.length;s++) {
        ((arrayy[s].trim()).charCodeAt(0) == (arrayy2[s].trim()).charCodeAt(0)) ? count++ : console.log('not done');
         }

         if(count == arrayy2.length) {
            status = 'You win';
             score = count;
             }
            else{ 
              status = 'You lose';
            }        
             
            if(count == arrayy2.length){
               $('.arrtext').css('color','green');
                 $('#checkword').css('display','none');
                 $('#nextbtn').css('display','block');
                 $('.arrtext').html(status);
                  $('.newscore').html('+' + score);
                 setTimeout(() => {
                     $('.newscore').html('');
                 }, 30000);
                

                 $.ajaxSetup({
                headers:{
                  'X-CSRF-TOKEN':$('meta[name="_token"').attr('content')
                }
              });
              $.ajax({
                url:"{{route('generate')}}",
                method:'GET',
                data:{score:score},
                success:function(result) {
                    console.log(result['success']);

                }
              });
                }
              else{ 
                $('.arrtext').css('color','red');
              }
              
        });
      });
  
</script>
@endsection

