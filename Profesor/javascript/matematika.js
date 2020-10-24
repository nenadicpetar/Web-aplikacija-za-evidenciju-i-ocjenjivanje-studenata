function calc()
{
    var m1,m2,m3,m4,m5,m6,m7,avg = 0,ukupno = 0, rezultat = "",ocjena = "";
    m1 = parseFloat(document.form1.pr.value);
    m2 = parseInt(document.form1.pred1.value);
    m3 = parseInt(document.form1.pred2.value);
    m4 = parseInt(document.form1.av1.value);
    m5 = parseInt(document.form1.av2.value);
    m6 = parseInt(document.form1.isp1.value);
    m7 = parseInt(document.form1.isp2.value);
    ukupno = m2+m3+m4+m5;
    avg = ukupno/4;
    if (m1 < 0.7 || m2 < 2 || m3 < 2 || m4 < 2 || m5 < 2) 
    {
        rezultat = "Student nije položio";
        ocjena = "1";
    }
    else if (avg >= 4.5 && avg <= 5)
    {
        rezultat = "Izvrstan";
        ocjena = "5";
    }
    else if (avg >=3.5 && avg < 4.5)
    {
        rezultat = "Vrlo dobar";
        ocjena = "4";
    }
    else if (avg >=2.5 && avg < 3.5)
    {
        rezultat = "Dobar";
        ocjena = "3";
    }
    else if (avg >=1.5 && avg < 2.5)
    {
        rezultat = "Dovoljan";
        ocjena = "2";
    }
    else if (avg < 1.5)
    {
        rezultat = "Student nije položio";
        ocjena = "1";
    }
    document.form1.rezultat.value = rezultat;
    document.form1.ocjena.value = ocjena;
    document.form1.ukupno.value = ukupno;
    document.form1.prosjek.value = avg;
}

function calc2() 
{
    var m1,m2,m3,ocjpred = 0, pred10 ="";
    m1 = parseFloat(document.form1.pr.value);
    m2 = parseInt(document.form1.pred1.value);
    m3 = parseInt(document.form1.pred2.value);
    ocjpred = (m2+m3)/2;
    if (m1 < 0.7 || m2 < 2 || m3 < 2) 
    {
        pred10 = "1";
    }
    else if (ocjpred >= 4.5 && ocjpred <= 5)
    {
        pred10 = "5";
    }
    else if (ocjpred >=3.5 && ocjpred < 4.5)
    {
        pred10 = "4";
    }
    else if (ocjpred >=2.5 && ocjpred < 3.5)
    {
        pred10 = "3";
    }
    else if (ocjpred >=1.5 && ocjpred < 2.5)
    {
        pred10 = "2";
    }
    else if (ocjpred < 1.5)
    {
        pred10 = "1";
    }
    document.form1.pred10.value = pred10;
    document.form1.ocjpred.value = ocjpred;
}          

function calc3()
{
    var m1,m4,m5,ocjav = 0, av10="";
    m1 = parseFloat(document.form1.pr.value);
    m4 = parseInt(document.form1.av1.value);
    m5 = parseInt(document.form1.av2.value);
    ocjav = (m4+m5)/2;

    if (m1 < 0.7 || m4 < 2 || m5 < 2) 
    {
        av10 = "1";
    }
    else if (ocjav >=4.5 && ocjav <= 5)
    {
        av10 = "5";
    }
    else if (ocjav >= 3.5 && ocjav < 4.5)
    {
        av10 = "4";
    }
    else if (ocjav >= 2.5 && ocjav < 3.5)
    {
        av10 = "3";
    }
    else if (ocjav >= 1.5 && ocjav < 2.5)
    {
        av10 = "2";
    }
    else if (ocjav < 1.5)
    {
        av10 = "1";
    }
    document.form1.av10.value = av10;
    document.form1.ocjav.value = ocjav;
}

function calc4() {
    var m1,m6,m7, ocjisp = 0, isp = "", rezultat = "", ocjena = "";
    m1 = parseFloat(document.form1.pr.value);
    m6 = parseInt(document.form1.isp1.value);
    m7 = parseInt(document.form1.isp2.value);
    ocjisp = (m6+m7)/2;

    if (m1 < 0.7 || m6 < 2 || m7 < 2)
    {
        rezultat = "Student nije položio";
        ocjena = "1";
        isp = "1";
    }
    else if(ocjisp >= 4.5 && ocjisp <= 5)
    {
        rezultat = "Izvrstan";
        ocjena = "5";
        isp = "5";   
    }
    else if(ocjisp >= 3.5 && ocjisp < 4.5)
    {
        rezultat = "Vrlo dobar";
        ocjena = "4";
        isp = "4";
    }
    else if(ocjisp >= 2.5 && ocjisp < 3.5)
    {
        rezultat = "Dobar";
        ocjena = "3";
        isp = "3";
    }
    else if(ocjisp >= 1.5 && ocjisp < 2.5)
    {
        rezultat = "Dovoljan";
        ocjena = "2";
        isp = "2";
    }
    else if (ocjisp < 1.5)
    {
        rezultat = "Student nije položio";
        ocjena = "1";
        isp = "1";
    }
    document.form1.rezultat.value = rezultat;
    document.form1.ocjena.value = ocjena;
    document.form1.isp.value = isp;
    document.form1.ocjisp.value = ocjisp;
}