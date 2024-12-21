<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('/main.css') }}">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- <link rel="stylesheet" href="{{ asset('/sanitize.css') }}"> --}}
        <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    </head>
    <body id="app" class="font-sans antialiased">
        
        <div class="min-h-screen bg-gray-30">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

<div class="top center w-full">
    <div class="count_page ">
        @if($set_goal ==! null)
        <div class="count_down">

{{-- <small>{{json_encode($set_goal->howLongTime())}}</small> --}}
<div>
    <count-down-timer  :deadline="{{ json_encode($set_goal->howLongTime()) }}" />
    </div>           
          
            <div class="mt-7">
                <div class="content ">
       
                    <form action="/goals/done/{{ $set_goal->id }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input class="top_button" type="submit" value="できた！">
                    </form>
                </div>
                <div class="edit">
                    <a  class="top_button" href="/goals/{{ $set_goal->id }}/edit">編集する</a>
                </div>
            </div>
        </div>     
        
        
        
        <div class="card">
            <div>
                <div class="card_title">
                    <h4>
                        <a href="/goals/{{ $set_goal->id }}">{{ $set_goal->goals_name }}</a>
                    </h4>
                </div>   
              
                <p>期限：{{ $set_goal->formatDate()}}</p>
                <p>条件：{{ $set_goal->goals_conditions}}</p>
                <p>ごほうび：{{ $set_goal->goals_reward}}</p>
                
            </div>
            
            <div class="content mt-10">
                <form action="/goals/set/{{ $set_goal->id }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input class="button" type="submit" value="もとに戻す">
                </form>
            </div>
            <div class="content">
                <form action="/goals/{{ $set_goal->id }}" id="form_{{ $set_goal->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="button" type="button" onclick="deleteGoal({{ $set_goal->id }})">delete</button>
                </form>
            </div>
        </div>
        @else
        <div id="animation"  class="none_title">
            <h1 class="">今日は、何をしよう</h1>
            <small>ひとつのタスクを選択しよう</small>
        </div>
        @endif
    </div>
</div>
<div class="center create_bar">
    <test-component></test-component>
    <a href='/goals/create' class="button create create_button" value="新しくつくる">
        つくる
        </a>

</div>

<div class="cards_wrapper w-full">
    <h3>あとでやる</h3>
    <div class="grid gap-7 sm:grid-cols-2 md:gap-8 xl:grid-cols-3">
        @foreach($own_posts as $goal)
        @if($goal->goals_is_achieved == 0)
        @if($goal->goals_is_set == 0)
        <div class="">
      
            <div class="card">
                <div>
                    <div class="card_title">
                        <h4><a href="/goals/{{ $goal->id }}">{{ $goal->goals_name }}</a></h4>
                    </div>   
                  <p>
                

                  </p>
                                  
                    <p>期限：{{ $goal->formatDate()}}</p>
                    <p>条件：{{ $goal->goals_conditions}}</p>
                    <p>ごほうび：{{ $goal->goals_reward}}</p>
                    
                </div>
                
                <div class="content">
                    <form action="/goals/set/{{ $goal->id }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input class="button" type="submit" value="スタート">
                    </form>
                </div>
                <div class="content">
                    <form action="/goals/{{ $goal->id }}" id="form_{{ $goal->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="button" type="button" onclick="deleteGoal({{ $goal->id }})">削除する</button>
                                            </form>
                </div>

                </div>
        </div>
        @endif
        @endif
        @endforeach
    </div>
    


<div class="cards_wrapper w-full ">

  <h3>達成済み</h3>
    <div class="grid gap-7 sm:grid-cols-2 md:gap-8 xl:grid-cols-3">
            @foreach($own_posts as $goal)
            @if($goal->goals_is_achieved == 1)
            <div class="card">
                <div>
                    <div class="card_title">
                        <h4><a href="/goals/{{ $goal->id }}">{{ $goal->goals_name }}</a></h4>
                    </div>   
                    <p>期限：{{ $goal->formatDate()}}</p>
                    <p>条件：{{ $goal->goals_conditions}}</p>
                    <p>ごほうび：{{ $goal->goals_reward}}</p>
                    
                </div>
                
                <div class="content">
                    <form action="/goals/set/{{ $goal->id }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input class="button" type="submit" value="リセット">
                    </form>
                </div>
                <div class="content">
                    <form action="/goals/{{ $goal->id }}" id="form_{{ $goal->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="button" type="button" onclick="deleteGoal({{ $goal->id }})">delete</button>
                        
                    </form>
                </div>
                <div class="content">
                    <form action="/goals/done/{{ $goal->id }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input class="button" type="submit" value="完了">
                    </form>
                </div>
                
            </div>
            @endif
            @endforeach
        </div>
  
</div>



</div>







<style scoped>
.cards_wrapper{
   width: 95%;
   margin: 0 auto;
   max-width: 1200px;
}
    .create_bar{
        margin-bottom: 3rem;
    }
    .top_button{
        width: 8rem;
        height: 2rem;
        border-radius: 58px;
        background: #fff;
        flex-shrink: 0;
        color: #333;
        text-align: center;
        font-family: "Ryo Gothic PlusN";
        font-size: 16px;
        font-style: normal;
        font-weight: 800;
        line-height: 2rem;
        border: none;
        margin-bottom: 1rem;
        /* text-align: center; */
    }
    .count_down{
        color: #333;
        font-family: sans-serif;
        font-weight: 550;
        font-family: "Ryo Gothic PlusN";
        color: #FFF;
        font-size: 1.5rem;

    }
    .top_card_cover{
        position: absolute;
        top: 0;
        right: 0;
         margin:0 2%;
        display:inline-block;
        background:#fff;
        transform:skewX(30deg);
        width:30%;
        height: 100%;
    }
    .top{
   padding:3rem 0;
        background: #5CE5B4;
        min-height: 25rem;
    
    }
    .count_page{
      width: 50%;
      display: flex;
        justify-content: center;
    
        align-items: center;
    }
    @media screen and (max-width: 768px) {
        .count_page{
            width: 100%;
            display: flex;
            flex-direction: column;
        }
    }
    p,h4{
        color: #333;
        font-family: sans-serif;
        font-weight: 550;
        font-family: "Ryo Gothic PlusN";
    }
    .center {
        display: flex;
        justify-content: center;
        width: 100%;
    }
    .card p{
      padding-left: 1rem;
      padding-top: 1rem;
    }
    .card {
        width: 80%;
        max-width: 300px;
        margin: 0 auto;
        max-height: 400px;
/* flex-shrink: 0; */

        border-radius: 6px;
        background: #FFF;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);

    }
.create{
    margin: 3rem;
}
    .content {
display: flex;
justify-content: center
    }

    .content_goal {
        display: flex;
        justify-content: space-around;
    }

    .footer {
        display: flex;
        justify-content: space-around;
    }

    .edit {
        display: flex;
        justify-content: space-around;
    }

    .back {
        display: flex;
        justify-content: space-around;
    }

    .goal {
        display: flex;
        justify-content: space-around;
    }

    .card_title {
        display: flex;
        justify-content: flex-start;
        background: #5CE5B4;
        color: #FFF;
        padding-left: 5%;
        width: 100%;
        min-height: 2rem;
        border-radius: 2px 2px 0 0;
        
    }
    .card_title a {
    
        color: #FFF;
    
    }
    .card p{
        color: #5CE5B4;
    }

    .body {
        display: flex;
        justify-content: space-around;
    }

    .title__error {
        display: flex;
        justify-content: space-around;
    }

    .body__error {
        display: flex;
        justify-content: space-around;
    }

    .button{
        width: 8rem;
        height: 2rem;
        border-radius: 58px;
        background: #5CE5B4;
        flex-shrink: 0;
        color: #FFF;
        text-align: center;
        font-family: "Ryo Gothic PlusN";
        font-size: 16px;
        font-style: normal;
        font-weight: 800;
        line-height: normal;
        border: none;
        margin-bottom: 1rem;
    }
        
button:active,input[type="submit"]:active {
  translate: 0 0.225em;
  box-shadow: inset 0 0.03em 0 0 #f4f4f4, 0 0.03em 0 0 #efefef,
    0 0.0625em 0 0 #ececec, 0 0.125em 0 0 #e0e0e0, 0 0.125em 0 0 #dedede,
    0 0.2em 0 0 #dcdcdc, 0 0.225em 0 0 #cacaca, 0 0.225em 0.375em 0 #cecece;
}

a {
  text-decoration: none;
  color: #000000;
  text-align: center;
  
}
a:active {
  color: #000000;
}
.none_title{

    display: flex;
    flex-direction: column;
    align-items: center;
    color: #FFF;

}
.none_title h1{

    font-size: 2rem;
}
.create_button{
    width: 8rem;
    height: 2rem;
    border-radius: 58px;
    background: #5CE5B4;
    flex-shrink: 0;
    color: #FFF;
    text-align: center;
    font-family: "Ryo Gothic PlusN";
    font-size: 16px;
    font-style: normal;
    font-weight: 800;
   
 
  

</style>

<script>
    function deleteGoal(id) {
        'use strict'

        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
            document.getElementById(`form_${id}`).submit();
        }
    }
</script>
