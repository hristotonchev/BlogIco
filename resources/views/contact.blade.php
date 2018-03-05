@extends('layouts.public')
@section('pageTitle','Contacts')
@section('content')
<div class="page padding-bottom">
 <div class="content_wrap">
   <div class="left-panel">
     <div class="generic-content">
       <div class="title">
         <h1>Contact us</h1>
         <h2>Fell free to contact us 24/7, we will try to give you a feedback ASAP</h2>
       </div>
       <div class="content">
         <div class="address martop">
           <div class="panel">
             <div class="title">
               <h1>First Address</h1>
             </div>
             <div class="content">
               <p>10 B Pierce O'Mahony str,<br />
                Sofia, Bulgaria</p>
               <p class="padTop"><span>Phone :</span> +359 883 51 69 9*</p>
               <p><span>Email :</span> <a href="mailto:info@companyname.com">hristo.tonchev@gmail.com</a></p>
             </div>
           </div>
           <div class="panel marginTop">
             <div class="title">
               <h1>Second Address</h1>
             </div>
             <div class="content">
               <p>4 Kaloynanova Krepost str,<br />
                 Sofia, Bulgaria</p>
               <p class="padTop"><span>Phone :</span> +359 877 525 14*</p>
               <p><span>Email :</span> <a href="mailto:info@companyname.com">dispina.savopulo@gmail.com</a></p>
             </div>
           </div>
         </div>
       </div>
     </div>
     <div class="clear"></div>
   </div>
@endsection
@section('sidebar')
@parent
@endsection
