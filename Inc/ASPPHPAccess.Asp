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
fUNcTIoN gETwHErEAnD(bYVaL a, bYVaL b)
dIM c, d
iF tRIm(b) = "" tHEn gETwHErEAnD = a : eXIt fUNcTIoN
iF iNStR(lCAsE(a), " where ") > 0 tHEn
d = " And "
eLSe
d = " Where "
eND iF
iF b <> "" tHEn
b = tRIm(b)
c = lCAsE(b)
iF lEFt(c, 6) = "order " oR lEFt(c, 6) = "group " tHEn
gETwHErEAnD = a & " " & b : eXIt fUNcTIoN 	
eLSeIF lEFt(c, 6) = "where " tHEn
b = mID(b, 7)
eLSeIF lEFt(c, 4) = "and " tHEn
b = mID(b, 5)
eND iF
a = a & d & b
eND iF
gETwHErEAnD = a
eND fUNcTIoN
fUNcTIoN oRAnDSeARcH(a, b, c)
dIM d, e, f
c = rEGeXP_REpLAcE(c, " or ", " Or ")
c = rEGeXP_REpLAcE(c, " and ", " And ")
iF iNStR(c, " Or ") > 0 tHEn
d = sPLiT(c, " Or ")
fOR eACh e iN d
iF e <> "" tHEn
iF f <> "" tHEn f = f & " Or "
f = f & " " & b & " Like '%" & e & "%'"
eND iF
nEXt
eLSeIF iNStR(c, " And ") > 0 tHEn
d = sPLiT(c, " And ")
fOR eACh e iN d
iF e <> "" tHEn
iF f <> "" tHEn f = f & " And "
f = f & " " & b & " Like '%" & e & "%'"
eND iF
nEXt
eLSeIF c <> "" tHEn
d = sPLiT(c, " And ")
fOR eACh e iN d
iF e <> "" tHEn
iF f <> "" tHEn f = f & " And "
f = f & " " & b & " Like '%" & e & "%'"
eND iF
nEXt
eND iF
iF f <> "" tHEn
iF iNStR(lCAsE(a), " where ") = 0 tHEn
f = " Where " & f
eLSe
f = " And " & f
eND iF
a = a & f
eND iF
oRAnDSeARcH = a
eND fUNcTIoN
%>