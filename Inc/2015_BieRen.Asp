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
fUNcTIoN cLOsEHtML(bYVaL a)
oN eRRoR rESuME nEXt
dIM b, c, d, e, f, g, h, i, j, k : b = a
sET h = cREaTEoBJeCT("VBscript.RegExp")
h.iGNoREcASe = tRUe
h.gLObAL = tRUe
c = "p,div,span,table,ul,font,b,u,i,h1,h2,h3,h4,h5,h6"
d = sPLiT(c,",")
fOR e = 0 tO uBOuND(d)
f = 0
g = 0
h.pATtERn = "<(" + tRIm(d(e)) + ")((\s+[^<>])+|)>"
sET i = h.eXEcUTe(b)
fOR eACh k iN i
f = f + 1
b = rEPlACe(b, k.vALuE, "<"& lCAsE(k.sUBmATcHEs(0)) & k.sUBmATcHEs(1) &">")
nEXt
h.pATtERn = "<\/" + d(e) + ">"
sET i = h.eXEcUTe(b)
fOR eACh k iN i
g = g + 1
b = rEPlACe(b, k.vALuE, "</"& lCAsE(k.sUBmATcHEs(0)) &">")
nEXt
fOR j = 1 tO f - g
b = b + "</" + d(e) + ">"
nEXt
nEXt
cLOsEHtML = b
sET h = nOThINg
eND fUNcTIoN
%>