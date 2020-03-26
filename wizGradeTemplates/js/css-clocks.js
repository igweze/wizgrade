function date_time(id){
        date = new Date;
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        document.getElementById("sec-clock").innerHTML = ''+s;
        document.getElementById("min-clock").innerHTML = ''+m;
        document.getElementById("hour-clock").innerHTML = ''+h;
        setTimeout('date_time("'+"s"+'");','1000');
        return true;
}
window.onload = date_time('sec-clock');
