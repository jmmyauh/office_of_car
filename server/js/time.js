function set2(num) {
  // 桁数が1桁だったら先頭に0を加えて2桁に調整する
  let ret;
  if (num < 10) { ret = "0" + num; }
  else { ret = num; }
  return ret;
}
function showClock() {
  const nowTime = new Date(); //現在日時
  const nowYear = set2(nowTime.getFullYear()); //年
  const nowMouth = set2(nowTime.getMonth() + 1); //月
  const nowDate = set2(nowTime.getDate()); //日
  const nowHour = set2(nowTime.getHours()); //時間
  const nowMin = set2(nowTime.getMinutes()); //分
  const nowSec = set2(nowTime.getSeconds()); //秒
  const msg = nowYear + "年" + nowMouth + "月" + nowDate + "日" + nowHour + ":" + nowMin + ":" + nowSec ;
  document.getElementById("showTime").innerHTML = msg;
}
setInterval('showClock()', 1000);


function set2fig(num) {
   // 桁数が1桁だったら先頭に0を加えて2桁に調整する
    var ret;
    if( num < 10 ) { ret = "0" + num; }
    else { ret = num; }
    return ret;
}
function showClock2() {
    var nowTime = new Date();
    var nowYear = set2fig( nowTime.getFullYear()); //年
    var nowMouth = set2fig( nowTime.getMonth() + 1); //月
    var nowDate = set2fig( nowTime.getDate()); //日
    var nowHour = set2fig( nowTime.getHours() );
    var nowMin  = set2fig( nowTime.getMinutes() );
    var nowSec  = set2fig( nowTime.getSeconds() );
    var msg = nowYear + "年" + nowMouth + "月" + nowDate + "日" + nowHour + "時" + nowMin + "分" + nowSec + "秒";
    document.getElementById("RealtimeClockArea2").innerHTML = msg;
}
setInterval('showClock2()',1000);
