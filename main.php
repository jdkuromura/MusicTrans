<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>MusicTrans Main</title>

    <style>
    @import url(https://fonts.googleapis.com/css?family=Exo:100,200,400);
@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);

body{
  margin: 0;
  padding: 0;
  background: #fff;

  color: #fff;
  font-family: Arial;
  font-size: 12px;
}

.body{
  position: absolute;
  top: -20px;
  left: -20px;
  right: -40px;
  bottom: -40px;
  width: auto;
  height: auto;
  background-image: url(5ea5a6375B15D.jpg);
  background-size: cover;
  -webkit-filter: blur(5px);
  z-index: 0;
}

.grad{
  position: absolute;
  top: -20px;
  left: -20px;
  right: -40px;
  bottom: -40px;
  width: auto;
  height: auto;
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
  z-index: 1;
  opacity: 0.7;
}

.header{
  position: absolute;
  top: calc(50% - 35px);
  left: calc(50% - 255px);
  z-index: 2;
}

.title{
  position: absolute;
  top: calc(50% - 160px);
  left: calc(50% - 0px);
  float: left;
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 35px;
  font-weight: 200;
}

.header div span{
  color: #5379fa !important;
}


.mix{
  float: left;
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 20px;
  font-weight: 200;
  white-space: nowrap;
  position: absolute;
  top: calc(50% - 40px);
  left: calc(50% - 10px);
}

.select{
  position: absolute;
  top: calc(50% - 0px);
  left: calc(50% - -50px);
  height: 50px;
  width: 300px;
  padding: 1px;
  z-index: 2;
  font-family: 'Exo', sans-serif;
  font-size: 15px;
  font-weight: 200;
  background: #fff;
  border: 1px solid #fff;
  cursor: pointer;
  border-radius: 2px;
  color: #a18d6c;
}

.musicplay{
  position: absolute;
  top: calc(50% - -70px);
  left: calc(50% - 10px);
  height: 50px;
  width: 300px;
  padding: 1px;
  z-index: 2;
  font-family: 'Exo', sans-serif;
  font-size: 15px;
  font-weight: 200;
}

    </style>
</head>
<body>
<div class="body"></div>
    <div class="grad"></div>
    <?php
$upfilename = $_FILES['uploadfile']['name'];
$tmpfilename = $_FILES['uploadfile']['tmp_name'];
move_uploaded_file($_FILES["uploadfile"]["tmp_name"], "./files/$upfilename");
?>
 <div class="header">
 <div class="title">Enjoy<br>Music<span>Trans</span></div>
 
<div class="mix">
  <div class="controls">
    <label>mix level</label>
    <input type="range" value="100" step="1" min="0" max="100" oninput="changeValue(this.value, 'mix');"></input>
    <label><br><br>Select the place</label>
    <select class="select" id="impulse" size="1" onchange="loadImpulse(this.value)";>
      <option value="soundfield_s1r1.wav">Patric's Church</option>
      <option value="falkland_tennis_court_b_format.wav">Falkland tennis court</option>
      <option value="ir_centre_stalls.wav">central hall in University of York</option>
      <option value="rir_jack_lyons_lp1_96k.wav">jack lyons concert hall in University of York</option>
      <option value="average_space_ir_0.wav">drum studio</option>
      <option value="tunnel_entrance_f_1way_mono_processed.mp3">innocent railway tunnel</option>
      <option value="r1_bformat.wav">R1 nuclear reactor hall</option>
    </select>
  </div>
</div>

<div class="musicplay">
<audio id="player" crossorigin controls>
  <source src="<?php echo("./files/$upfilename"); ?>">
  Your browser does not support the audio tag.
</audio>
</div>

<script>

var context = new AudioContext();
var audioElement = document.getElementById('player');
var carrier = context.createMediaElementSource(audioElement);
var convolver = context.createConvolver();
var dry = context.createGain();
var wet = context.createGain();

carrier.connect( convolver );

convolver.connect(wet);
carrier.connect(dry);

dry.connect( context.destination );
wet.connect( context.destination );

var mix = function( value ) {
	dry.gain.value = ( 1.0 - value );
	wet.gain.value = value;
}

var loadImpulse = function ( fileName )
{
  var url = "http://kuromura.php.xdomain.jp/impulse/" + fileName;
  var request = new XMLHttpRequest();
  request.open( "GET", url, true );
  request.responseType = "arraybuffer";
  request.onload = function ()
  {
    context.decodeAudioData( request.response, function ( buffer ) {
      convolver.buffer = buffer;
    }, function ( e ) { console.log( e ); } );
  };request.onerror = function ( e )
  {
    console.log( e );
  };
  request.send();
};

loadImpulse(document.getElementById('impulse').value);
mix(1.0);

function changeValue(string,type)
{
  var value = parseFloat(string) / 100.0;

  switch(type)
  {
    case 'mix':
		mix(value);
      break;
  }
}
   </script>
   </div>
</body>
</html>