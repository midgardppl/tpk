

select * from pengawasdosen where nip=1938;
select pg.namapegawai, ta.tahunajaran, sem.`NAMASEMESTER`, 
CASE 
    WHEN uts_or_uas=0 THEN  'UTS'
    ELSE  'UAS'
END AS 'MASA UJIAN'
from pengawasdosen pd, pegawai pg, tahunajaran ta, semester sem 
WHERE  1938=pg.`NIP`AND ta.`KODETHNAJARAN`=pd.kd_thn_ajaran AND sem.`KODESEMESTER`=pd.kd_semester;