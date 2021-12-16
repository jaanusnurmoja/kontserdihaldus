let i;
let freq;
let value = 27.5;
let step = 2 ** (1 / 12);
let n = 0;
let c = 0;
let color;
let colspan;

document.write(
"<table style='border: solid black 1px; border-collapse:collapse;'>"
  );

  // Siin tuleb teha kunstlik tabelirida kõikide td-dega
  // ärge küsige, miks :)

  document.write("<tr>");
    for (i = 0; i < 88; i++) { if (i % 12==0) { n=i; } if (i==0 || [2, 3, 7, 8].includes(i - n)) { colspan=3; } else {
      colspan=2; } for (x=0; x < colspan; x++) { document.write("<td style='width:13px;''></td>");
      }
    }
    // Näitame rahvale nootide sageduste numbreid.
    document.write("</tr>");
    document.write("<tr>");
    for (i = 0; i < 88; i++) {
      // leiame iga la noodi
      if (i % 12 == 0) {
        n = i;
      }
      // colspan sõltub sellest, millise klahvi kohal
      if (i == 0 || [2, 3, 7, 8].includes(i - n)) {
        colspan = 3;
      } else {
        colspan = 2;
      }

      // sagedus võrdub esimese klahvi sagedus korda
      // pooltooni intervall astmes konkreetne kordus
      freq = (value * step ** i).toFixed(2);

      document.write(
        "<td colspan='" +
        colspan +
        "' style='border:solid gray 1px;writing-mode: vertical-rl;text-orientation: mixed; transform:rotate(180deg);font-size: 10px;'>"
      );
      document.write(freq);
      document.write("</td>");
      }
      document.write("</tr>");

  // Siin loome klahvide tagumise poole, kus valged ja mustad vahelduvad
  document.write("<tr>");
for (i = 0; i < 88; i++) {
  if (i % 12 == 0) { n = i; } if (![1, 4, 6, 9, 11].includes(i - n)) { color = "transparent"; }
  if
      (i==0 || [2, 3, 7, 8].includes(i - n)) { colspan=3; } else { colspan=2; } freq=value * step ** i;
      document.write( "<td  colspan=" + colspan + " style='background:" + color
      + ";border:solid black 1px; border-bottom: 0px;max-width:16px;height:70px;'>" ); //document.write(freq + " " + n);
      document.write("</td>");
      }

      document.write("</tr>");

  // Siin joonistame valgete klahvide esiotsa arvestades mh seda,
  // et enamasti on valgete klahvide vahel must klahv,
  // millele valged klahvid peavad ruumi tegema veerandi osas
  // oma laiusest
  document.write("<tr>");

    for (i = 0; i < 88; i++) { if (i % 12==0) { n=i; } if ([0, 2, 3, 5, 7, 8, 10].includes(i - n)) { freq=value * step
      ** i;
      document.write( "<td colspan='4' style='background:white;border:solid black 1px;border-top:0;min-width:24.3px;max-width:24.3px;height:50px;'>"
      ); //document.write(freq + " " + n); document.write("</td>");
      }
      }
      document.write("</tr>");
  document.write("</table>");