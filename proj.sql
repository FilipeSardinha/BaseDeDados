/*QUERIES*/

/*Q1*/

select userid
from (
  select userid , sum(sucesso = 1) as sucessos,
                  sum(sucesso = 0) as insucessos
  from login
  group by userid) as auxtable
where insucessos > sucessos;

/*Q2*/
select r.regcounter, r.userid
from registo r
where not exists(
  select
)

/*Q3*/
select userid
from





SELECT R.regcounter, R.userid
FROM registo R
WHERE NOT EXISTS (
    SELECT RP1.pageid
    FROM reg_pag RP1
    WHERE NOT EXISTS (
        SELECT RP.pageid
        FROM reg_pag RP
        WHERE RP.pageid = RP1.pageid
            AND RP.regid = R.regcounter
            AND RP.ativa = TRUE
            AND R.ativo = TRUE)
            AND RP1.userid = R.userid)
            order by userid;


select userid, count(*)
from registo
order by userid;



select r.regcounter
from registo r
where not exists(
  select p.pagecounter
  from pagina p
  where not exists(
    select rp.pageid
    from reg_pag rp
    where rp.pageid = p.pagecounter
    and rp.userid = r.userid
  )
);

select r.userid,r.regcounter,rp.pageid
from registo r, reg_pag rp
where r.userid = rp.userid
order by userid;

select r.userid, r.regcounter
from registo r
order by userid;
 /*            asdasddsdsda*/
/*nº reg por pag*/
select rp.userid
from (

select count(*) as nreg, rp.pageid
from registo r, reg_pag rp
where r.userid = rp.userid
group by pageid
) as tablea;

select rp.userid, rp.pageid, avg(nreg)
from reg_pag rp(
  select rp.userid, count(*) as nreg, rp.pageid
  from registo r
  where r.userid = rp.userid
  group by pageid ) as tablea
group by pageid;
