<style>
td {
  vertical-align: middle;
  line-height: 1.2; /* Atur sesuai kebutuhan Anda */
}

.ohy {
  border-collapse: collapse;
  border: 1px solid;
  padding-top: 3px;
  padding-bottom: 3px;
}

.upp {
    vertical-align: middle;
    line-height: 0.5; /* Atur sesuai kebutuhan Anda */
    
}
.checkbox-container {
        height: 100%;
        display: flex;
        align-items: center;
    }
    .checkbox-container input[type="checkbox"] {
        margin: 0;
    }
    
.tdd {
  border-collapse: collapse;
  border: 1px solid;
  padding-top: 1.9px;
  padding-bottom: 1.9px;
}

.line {
  border: 0;
  border-style: inset;
  border-top: 1px solid #000;
}

@page {
  margin: 4px;
}

.p {
  face: Arial, Helvetica, sans-serif;
}

body {
  margin: 4px;
  font-size: 11px;
}
</style>


<table style='border-collapse: collapse; border: 1px solid #000; width: 100%;'>
    <tr>
        <td style="position: relative;">
            <img src="{{ public_path('identitas/'.session('logo')) }}" width="100px" height="70px" style="position: absolute; left: 50px; top: 3px; padding: 5px;">
            <div style="padding-left: 100px; text-align: center;">
                <div style="font-size: 18px; font-weight: bold;">Badan Amil Zakat Nasional</div>
                <div style="font-size: 24px; font-weight: bold;">{{ session('nama') }}</div>
                <div style="font-size: 12px; font-style: italic;">{{ session('lokasi') }}</div>
                <div style="font-size: 12px;">Website: {{ session('website') }} , Email: {{ session('email') }}
                </div>
            </div>
        </td>
    </tr>
</table>

 
<table style='border-left: 1px solid; border-right:1px solid; width: 100%;'>
    <tr>
        <td style="font: bold; text-align: center; font-size: 12px;">SURVEY MUSTAHIK (PERORANGAN)</td>
    </tr>
</table>

<table style='border-left: 1px solid; border-top: 1px solid; border-right:1px solid; width: 100%; '>
    <tr>
        <td width="120px">Nama Mustahik     </td>
        <td  width="50%">: {{ $data->nama_pemohon }}</td>
        <td  width="10%"> Telp</td>
        <td  width="40%">:{{ $data->hp }}</td>
    </tr>
</table>

<table style='border-left: 1px solid; border-top: 1px solid; border-right:1px solid; width: 100%; border-bottom: 1px solid;'>
    <tr>
        <td width="120px">Alamat    </td>
        <td  width="50%">: {{ $data->alamat_lengkap }}</td>
    </tr>
</table>

<table style='border-left: 1px solid; border-right:1px solid; width: 100%;'>
    <tr>
        <td style="font: bold; text-align: center; font-size: 12px;">INDEKS RUMAH</td>
    </tr>
</table>


<table style='border-left: 1px solid; border-top: 1px solid; border-right:1px solid; width: 100%; background-color: #dee2e6'>
    <tr>
                <td width="120px" height="5px" class="upp">1. Ukuran rumah     </td>
                <td width="3px">:     </td>

   <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td  class="upp" style="vertical-align: middle;">
            Sangat Kecil 
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="vertical-align: middle;">
             Kecil 
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="vertical-align: middle;">
            Sedang
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="vertical-align: middle;">
            Besar
   </td>
  
    </tr>
</table>


<table style='border-left: 1px solid; border-top: 1px solid; border-right:1px solid; width: 100%; '>
    <tr>
                <td width="120px" class="upp">2. Dinding rumah     </td>
                <td width="3px">:     </td>

   <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="width: 100px;">
            Bilik Bambu/Kayu 
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="width: 90px;">
             Semi Permanen 
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="width: 90px;">
            Tembok/Beton
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="vertical-align: middle;">
            Lainnya ...................
   </td>
  
    </tr>
</table>


<table style='border-left: 1px solid; border-top: 1px solid; border-right:1px solid; width: 100%; background-color: #dee2e6'>
    <tr>
                <td width="120px" class="upp">3. Lantai      </td>
                <td width="3px">:     </td>

   <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td  class="upp" style="vertical-align: middle;">
            Tanah,           
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="vertical-align: middle;">
              Panggung,           
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="vertical-align: middle;">
             Semen,         
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="vertical-align: middle;">
               Keramik
   </td>
  
    </tr>
</table>




<table style='border-left: 1px solid; border-top: 1px solid; border-right:1px solid; width: 100%; '>
    <tr>
                <td width="120px" class="upp">4. Atap-Atap  </td>
                <td width="3px">:     </td>

   <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="width: 60px;">
            Kirai/ijuk,         
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="width: 90px;">
                Genteng/seng,           
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="width: 90px;">
              Asbes/Berglazur 
   </td>
    <td class="upp" style="width: 15px;">
 <!--            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
  -->  </td>
   <td class="upp" style="vertical-align: middle;">
 <!--            Lainnya ...................
  -->  </td>
  
    </tr>
</table>



<table style='border-left: 1px solid; border-top: 1px solid; border-right:1px solid; width: 100%; background-color: #dee2e6'>
    <tr>
                <td width="120px" class="upp">5. Mebel ruang tamu       </td>
                <td width="3px">:     </td>

   <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td  class="upp" style="vertical-align: middle;">
            Lesehan,     

   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="vertical-align: middle;">
                    Balai Bambu,            
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="vertical-align: middle;">
              Kayu,        
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="vertical-align: middle;">
                 Sofa    
   </td>
  
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="vertical-align: middle;">
                 Lainnya.............................    
   </td>
  
    </tr>
</table>




<table style='border-left: 1px solid; border-top: 1px solid; border-right:1px solid; width: 100%; '>
    <tr>
                <td width="120px" class="upp">6. Status rumah   </td>
                <td width="3px">:     </td>

   <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="width: 80px;">
           Milik Sendiri,            
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="width: 90px;">
                Sewa/Kontrak,         
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="width: 90px;">
                Ngindung,              
   </td>
    <td class="upp" style="width: 15px;">
         <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
  </td>
   <td class="upp" style="vertical-align: middle;">
                 Lainnya.............................        
 </td>
  
    </tr>
</table>




<table style='border-left: 1px solid; border-top: 1px solid; border-right:1px solid; width: 100%; background-color: #dee2e6'>
    <tr>
                <td width="120px" class="upp">7. Listrik, air, MCK        </td>
                <td width="3px">:     </td>

   <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td  class="upp" style="vertical-align: middle;">
              Tidak Ada          

   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="vertical-align: middle;">
                  Ada ……….Watt      
   </td>
    <td class="upp" style="width: 15px; ">
           Air 
   </td>
     <td class="upp" style="width: 15px;">
             <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="vertical-align: middle;">
            Sumur         
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="vertical-align: middle;">
                   PDAM    
   </td>

   <td class="upp" style="width: 15px; ">
           MCK 
   </td>
     <td class="upp" style="width: 15px;">
             <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="vertical-align: middle;">
            Punya         
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="vertical-align: middle;">
                   Tidak Punya    
   </td>

  
    </tr>
</table>




<table style='border-left: 1px solid; border-right:1px solid;  border-top:1px solid; width: 100%;'>
    <tr>
        <td style="font: bold; text-align: center; font-size: 12px;">KEPEMILIKAN TANAH</td>
    </tr>
</table>


  





<table style='border-left: 1px solid; border-top: 1px solid; border-right:1px solid; width: 100%; background-color: #dee2e6'>
   <tr>
                <td width="120px" class="upp">1. Kebun/Sawah  </td>
                <td width="3px">:     </td>

   <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="width: 80px;">
         Tidak Ada,       
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="width: 90px;">
               Ada         
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="width: 90px;">
               Luas < 1000 m²,   
   </td>
    <td class="upp" style="width: 15px;">
         <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
  </td>
   <td class="upp" style="vertical-align: middle;">
               1000-5000m²,     
 </td>
      <td class="upp" style="width: 15px;">
         <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
  </td>
   <td class="upp" style="vertical-align: middle;">
                 Luas >5000 m²
 </td>
  
    </tr>
</table>



<table style='border-left: 1px solid; border-top: 1px solid; border-right:1px solid; width: 100%; '>
    <tr>
                <td width="120px" class="upp">2. Elektronik    </td>
                <td width="3px">:     </td>

   <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="width: 50px;">
          Tidak Ada   
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="width: 50px;">
                 Radio/Tape,  
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="width: 25px;">
                  TV,               
   </td>
    <td class="upp" style="width: 15px;">
         <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
  </td>
   <td class="upp" style="vertical-align: middle;">
              CD Player,     
 </td>
   <td class="upp" style="width: 15px;">
         <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
  </td>
   <td class="upp" style="width: 25px">
             HP,          
 </td>
   <td class="upp" style="width: 15px;">
         <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
  </td>
   <td class="upp" style="width: 40px">
            Kulkas,      
 </td>
   <td class="upp" style="width: 15px;">
         <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
  </td>
   <td class="upp" style="vertical-align: middle;">
              Mesin Cuci, 
 </td>
   <td class="upp" style="width: 15px;">
         <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
  </td>
   <td class="upp" style="vertical-align: middle;">
            Lainnya.........  
 </td>
  
    </tr>
</table>





<table style='border-left: 1px solid; border-top: 1px solid; border-right:1px solid; width: 100%; background-color: #dee2e6'>
    <tr>
                <td width="120px" class="upp">3. Kendaraan      </td>
                <td width="3px">:     </td>

     <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="width: 50px;">
          Tidak Ada   
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" >
                  Sepeda Motor ........................  unit ........................ merk ........................ Tahun ........................               
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
     <td class="upp" style="width: 50px;">
          Mobil   
   </td>
  
    </tr>
</table>




<table style='border-left: 1px solid; border-top: 1px solid; border-right:1px solid; width: 100%; '>
    <tr>
                <td width="120px" class="upp">4. Ternak  </td>
                <td width="3px">:     </td>

   <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="width: 80px;">
         Tidak Ada,            
   </td>
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="">
                 Sapi/Kambing/Unggas...........ekor     
   </td>
  <!--   <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="width: 90px;">
                Ngindung,              
   </td>
    <td class="upp" style="width: 15px;">
         <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
  </td>
   <td class="upp" style="vertical-align: middle;">
                 Lainnya.............................        
 </td> -->
  
    </tr>
</table>




<table style='border-left: 1px solid; border-right:1px solid;  border-top:1px solid; width: 100%;'>
    <tr>
        <td style="font: bold; text-align: center; font-size: 12px;">BANTUAN YANG PERNAH DITERIMA</td>
    </tr>
</table>


<table style='border-left: 1px solid; border-top: 1px solid; border-right:1px solid; width: 100%; background-color: #dee2e6'>
    <tr>      
       <td class="upp" style="width: 15px; height: 12px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
       </td>
       <td  class="upp" style="width: 70px; height: 12px;">
                Belum pernah           
       </td>
        <td class="upp" style="width: 15px; height: 12px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
       </td>
       <td class="upp" style="width: 130px; height: 12px;">
                  Sudah pernah menerima,         
       </td>
       <td class="upp" style="vertical-align: middle; height: 12px;">
             berupa............................................. Rp............................................. Dari mana.............................................
       </td>
    </tr>
</table>


<table style='border-left: 1px solid; border-top: 1px solid; border-right:1px solid; width: 100%; background-color: #dee2e6'>
    <tr>      
       <td class="upp" style="width: 15px; height: 12px;">
           BPJS :     <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;"> Ada <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;"> Tidak Ada
       </td>
    </tr>
</table>


<table style='border-left: 1px solid; border-right:1px solid;  border-top:1px solid; width: 100%;'>
    <tr>
        <td style="font: bold; text-align: center; font-size: 12px;">TANGGUNGAN KELUARGA</td>
    </tr>
</table>



<table style='border-left: 1px solid; border-top: 1px solid; border-right:1px solid; width: 100%; background-color: #dee2e6'>
    <tr>
         
        
 
 
   <td  >
       Jumlah Tanggungan Keluarga : .............................................Jiwa
   </td>
   <!--  <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="vertical-align: middle;">
                 Sofa    
   </td>
  
    <td class="upp" style="width: 15px;">
            <input type="checkbox" name="report_myTextEditBox" style="width: 14px; height: 14px; vertical-align: middle; margin-top: -9px;">
   </td>
   <td class="upp" style="vertical-align: middle;">
                 Lainnya.............................    
   </td> -->
  
    </tr>
</table>


<table style='border-left: 1px solid; border-right:1px solid;  border-top:1px solid; width: 100%;'>
    <tr>
        <td style="font: bold; text-align: center; font-size: 12px;">KEUANGAN KELUARGA (HAD KIFAYAH  BERDASARKAN PUSKAS BAZNAS Rp. 715,679 / ORANG)</td>
    </tr>
</table>


<table style='border-collapse: collapse;  width: 100%; '>
    <tr>
                <td width="250px"  colspan="2" class="tdd"> Pendapatan Keluarga (bersumber dari)   </td>
                <td width="100px" class="tdd" > Nominal (Rp/bulan) </td>
                <td width="250px" class="tdd" colspan="2"> Pengeluaran Rutin dialokasikan untuk </td>
                <td width="100px"  class="tdd"> Nominal (Rp/bulan) </td>
   </tr>
</table>



<table style='border-collapse: collapse;  width: 100%; '>
    <tr>
                <td width="10px"  class="tdd" style="align-content: center;"> 1.   </td>
                <td width="277px" class="tdd"> Pekerjaan Suami ...........................   </td>
                <td width="50px" class="tdd" >  &nbsp; &nbsp; &nbsp; </td>
                <td width="10px"  class="tdd"  style="align-text: center;"> 1.   </td>
                <td width="275px" class="tdd"> Kebutuhan dapur/masak    </td>
                <td width="10px" class="tdd" >   &nbsp; &nbsp; &nbsp;  </td>
   </tr>
   <tr>
                <td width="10px"  class="tdd" style="align-content: center;"> 2.   </td>
                <td width="260px" class="tdd"> Pekerjaan Istri :  ...........................   </td>
                <td width="50px" class="tdd" >   &nbsp; &nbsp; &nbsp;  </td>
                <td width="10px"  class="tdd"  style="align-text: center;"> 2.   </td>
                <td width="240px" class="tdd"> KebPendidikan (SPP/Buku/Uang Saku, dll)    </td>
                <td width="100px" class="tdd" >  &nbsp; &nbsp; &nbsp;  </td>
   </tr>
   <tr>
                <td width="10px"  class="tdd" style="align-content: center;"> 3.   </td>
                <td width="240px" class="tdd"> Usaha lainnya : ...........................   </td>
                <td width="50px" class="tdd" >   &nbsp; &nbsp; &nbsp;  </td>
                <td width="10px"  class="tdd"  style="align-text: center;"> 3.   </td>
                <td width="240px" class="tdd"> Kesehatan (BPJS, biaya berobat,dll)    </td>
                <td width="100px" class="tdd" >  &nbsp; &nbsp; &nbsp;  </td>
   </tr>
   <tr>
                <td width="10px"  class="tdd" style="align-content: center;"> 4.   </td>
                <td width="240px" class="tdd"> Dari orang tua : ...........................   </td>
                <td width="102px" class="tdd" >   </td>
                <td width="10px"  class="tdd"  style="align-text: center;"> 4.   </td>
                <td width="240px" class="tdd"> Biaya listrik    </td>
                <td width="100px" class="tdd" >  </td>
   </tr>
   <tr>
                <td width="10px"  class="tdd" style="align-content: center;"> 5.   </td>
                <td width="240px" class="tdd"> Dari anak/menantu  ...........................   </td>
                <td width="102px" class="tdd" >   </td>
                <td width="10px"  class="tdd"  style="align-text: center;"> 5.   </td>
                <td width="240px" class="tdd"> Biaya air    </td>
                <td width="100px" class="tdd" >  </td>
   </tr>
   <tr>
                <td width="10px"  class="tdd" style="align-content: center;"> 6.   </td>
                <td width="240px" class="tdd"> Penghasilan lainnya sebutkan  :   </td>
                <td width="102px" class="tdd" >   </td>
                <td width="10px"  class="tdd"  style="align-text: center;"> 6.   </td>
                <td width="240px" class="tdd"> Iuran rutin RT/sejenisnya    </td>
                <td width="100px" class="tdd" >  </td>
   </tr>
   <tr>
                <td width="10px"  class="tdd" style="align-content: center;">  </td>
                <td width="240px" class="tdd">  </td>
                <td width="102px" class="tdd" >   </td>
                <td width="10px"  class="tdd"  style="align-text: center;"> 7.   </td>
                <td width="240px" class="tdd"> Service motor     </td>
                <td width="100px" class="tdd" >  </td>
   </tr>
     <tr>
                <td width="10px"  class="tdd" style="align-content: center;">  </td>
                <td width="240px" class="tdd">  </td>
                <td width="102px" class="tdd" >   </td>
                <td width="10px"  class="tdd"  style="align-text: center;"> 8.   </td>
                <td width="240px" class="tdd"> Transportasi  </td>
                <td width="100px" class="tdd" >  </td>
   </tr>
     <tr>
                <td width="10px"  class="tdd" style="align-content: center;">  </td>
                <td width="240px" class="tdd">  </td>
                <td width="102px" class="tdd" >   </td>
                <td width="10px"  class="tdd"  style="align-text: center;"> 9.   </td>
                <td width="240px" class="tdd"> Pengeluaran (sabun cuci, sabun mandi, deterjen & lainnya   </td>
                <td width="100px" class="tdd" >  </td>
   </tr>
     <tr>
                <td width="10px"  class="tdd" style="align-content: center;">  </td>
                <td width="240px" class="tdd">  </td>
                <td width="102px" class="tdd" >   </td>
                <td width="10px"  class="tdd"  style="align-text: center;"> 10.   </td>
                <td width="240px" class="tdd"> Pengeluaran lainya     </td>
                <td width="100px" class="tdd" >  </td>
   </tr>
     <tr>
                <td width="10px"  class="tdd" style="align-content: center;">  </td>
                <td width="240px" class="tdd"> TOTAL PEMASUKAN </td>
                <td width="102px" class="tdd" >   </td>
                <td width="10px"  class="tdd"  style="align-text: center;">    </td>
                <td width="240px" class="tdd"> TOTAL PENGELUARAN     </td>
                <td width="100px" class="tdd" >  </td>
   </tr>
   
</table>


<table style='border-collapse: collapse;  width: 100%; '>
    <tr>
                <td width="50%"  class="tdd" style="font: bold;font-size: 12px;"><center> REKAPITULASI KELAYAKAN  </center></td>
                <td width="50%" class="tdd"  style="font: bold;font-size: 12px;"><center> AKTIVITAS KEAGAMAAN </center></td>
   </tr>
</table>

<table style='border-collapse: collapse;  width: 100%;'>
    <tr bgcolor="#dee2e6">
                <td width="50%"  class="tdd">Indeks Rumah   &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;   &nbsp;   :        Layak     &nbsp; &nbsp;  &nbsp;  Tidak Layak </td>
                <td width="50%" class="tdd">Shalat  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  :  Dirumah,   &nbsp; &nbsp;  &nbsp; &nbsp; Dimasjid &nbsp; &nbsp;  &nbsp; &nbsp;  Tidak Shalat, </td>
   </tr>
    <tr >
                <td width="50%"  class="tdd">Kepemilikan Harta   &nbsp; &nbsp; &nbsp; &nbsp;   :        Layak     &nbsp; &nbsp;  &nbsp;  Tidak Layak </td>
                <td width="50%" class="tdd">Pengajian &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;  :  Rutin, &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; Pernah,  &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; Tidak Pernah </td>
   </tr>
   <tr bgcolor="#dee2e6">
                <td width="50%"  class="tdd">Pendapatan                      &nbsp; &nbsp; &nbsp; &nbsp;        &nbsp; &nbsp; &nbsp; &nbsp;   &nbsp;   &nbsp; :        Layak     &nbsp; &nbsp;  &nbsp;  Tidak Layak </td>
                <td width="50%" class="tdd">Infak/Sedekah  &nbsp; &nbsp;  :  Rutin, &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; Pernah,  &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; Tidak Pernah  </td>
   </tr>
</table>

<table style='border-left: 1px solid; border-right:1px solid;  border-top:1px solid; width: 100%;'>
    <tr>
        <td style="font: bold; text-align: left; font-size: 12px;">REKOMENDASI DAN PENJELASANNYA <br/><br/><br/>METODE PENDISTRIBUSIAN :<br/>
  TUNAI,  TRANSFER : NOREK :............................................................ BANK :................................ ATAS NAMA : ...................................... <br/>
  </td>
    </tr>
</table>
<table style='border-left: 1px solid; border-right:1px solid;  border-top:1px solid; width: 100%;'>
    <tr>
    <td width="50%" height="60px" style="font: bold; text-align: left; font-size: 12px;"><left>&nbsp;&nbsp; &nbsp;  a. Layak dibantu <br/>
  &nbsp;&nbsp; &nbsp; b. Tidak Layak dibantu<br/>
 &nbsp;&nbsp; &nbsp;  c. Dipertimbangkan<br/>
  </left></td>
    <td width="50%" height="60px" style="font: bold; text-align: left; font-size: 12px;"> <left> &nbsp;&nbsp; &nbsp;   a. Layak dibantu    Berupa :........................................................
<br/>
 &nbsp;&nbsp; &nbsp;  b. Tidak layak dibantu   &nbsp;&nbsp; &nbsp;  Nominal : Rp.............................................
 </left></td>
    </tr>
</table>

<table style='border-collapse: collapse;  width: 100%; '>
    <tr>
                <td width="20%" class="tdd" style="font: bold;font-size: 12px;"><br/><br/></td>
                <td class="tdd" style="font: bold;font-size: 12px;"><br/><br/></td>
                <td class="tdd" style="font: bold;font-size: 12px;"><br/><br/></td>
                <td class="tdd" style="font: bold;font-size: 12px;"><br/><center>{{ session('ka_proposal') }}</center><br/></td>
                <td class="tdd" style="font: bold;font-size: 12px;"><br/><br/></td>
                <td class="tdd" style="font: bold;font-size: 12px;"><center></center><br/></td>
   </tr>
    <tr>
                <td class="tdd" style="font: bold;font-size: 12px;"><center>Nama Petugas Survey</center></td>
                <td class="tdd" style="font: bold;font-size: 12px;"><center>Tanda Tangan</center></td>
                <td class="tdd" style="font: bold;font-size: 12px;"><center>Tgl</center></td>
                <td class="tdd" style="font: bold;font-size: 12px;"><center>WAKA II</center></td>
                <td class="tdd" style="font: bold;font-size: 12px;"><center>Tanda Tangan</center></td>
                <td class="tdd" style="font: bold;font-size: 12px;"><center>Tgl</center></td>
   </tr>
</table> 

