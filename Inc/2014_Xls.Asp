<%
'************************************************************
'���ߣ��ƶ� (��ͨASP/VB/PHP/JS/Flash��������������ϵ����)
'��Ȩ��Դ���빫����������;�������ʹ�á� 
'������2016-01-20
'��ϵ��QQ313801120  ����Ⱥ35915100(Ⱥ�����м�����)    ����313801120@qq.com   ������ҳ sharembweb.com
'����������ĵ������¡����Ⱥ(35915100)�����(sharembweb.com)���
'*                                    Powered By �ƶ� 
'************************************************************
%>
<%
fUNcTIoN bATcHImPOrTXlSFiLE(a,b)
dIM c,d,e,f,g,h,i,j,k,l,m,n,o
dIM p,q,r
q =  gETfILeFOlDErLIsT(a, tRUe, "xls", "", "", "", "")
r = sPLiT(q,vBCrLF)
fOR eACh p iN r
g="Provider=Microsoft.Jet.OLEDB.4.0;Data Source="& p &";Extended Properties='Excel 8.0;HDR=No;IMEX=1';"
cALl cLOsECoNN()
sET cONn=sERvER.cREaTEoBJeCT("adodb.connection")
sET rS = cREaTEoBJeCT("Adodb.RecordSet")
sET rSX = cREaTEoBJeCT("Adodb.RecordSet")
sET rSS = cREaTEoBJeCT("Adodb.RecordSet")
sET rST = cREaTEoBJeCT("Adodb.Recordset")
sET rSD = cREaTEoBJeCT("Adodb.Recordset")
sET tEMpRS = cREaTEoBJeCT("Adodb.RecordSet")
sET tEMpRS2 = cREaTEoBJeCT("Adodb.RecordSet")
sET rSTeMP = cREaTEoBJeCT("Adodb.RecordSet")	
cONn.oPEn  g
h = gETtABlELiST_COnN(cONn)
i = sPLiT(h,vBCrLF)
fOR eACh j iN i
iF j<>"" tHEn
k = gETfIElDLiST(j)
l = sPLiT(k,",")
iF uBOuND(l)<>-1 tHEn
rSX.oPEn"Select * From ["& j &"]",cONn,1,1
wHIlE nOT rSX.eOF
c=0
fOR eACh m iN l
iF m <>"" tHEn
o = rSX(c)
iF cHEcKUrL(o) = tRUe aND iNStR(vBCrLF & n & vBCrLF, vBCrLF & o & vBCrLF)=fALsE tHEn
n = n & o & vBCrLF
cALl eCHo(j,o):dOEvENtS
eND iF
c=c+1
eND iF
nEXt
rSX.mOVeNExT:wENd:rSX.cLOsE
eND iF
eND iF
nEXt
nEXt
n=cSTr(n)
cALl eCHo("UrlList",n)
cALl wRItEToFIlE(b,n,1)
eND fUNcTIoN
%>