<% 
'��־�ļ�

'������־
Function errorLog(content)
    If openErrorLog = True Then
        Call rw(content) 
    End If 
End Function 

'д��ϵͳ������־
Function writeSystemLog(tableName, msgStr)
    Dim logFile, s, url, ip, addDateTime 
    logFile = adminDir & "/data/systemLog/" & format_Time(Now(), 2) & ".txt" 
    url = ADSql(getThisUrlFileParam())
    addDateTime = format_Time(Now(), 1) 
    ip = getIP() 
    If InStr(openWriteSystemLog, "|txt|") > 0 Then
        s = s & "������" & Session("adminusername") & vbCrLf 
        s = s & "����" & tableName & vbCrLf 
        s = s & "��Ϣ��" & msgStr & vbCrLf 
        s = s & "��ַ��" & url & vbCrLf 
        s = s & "ʱ�䣺" & addDateTime & vbCrLf 
        s = s & "IP��" & ip & vbCrLf 
        s = s & "------------------------" & vbCrLf 
        Call createAddFile(logFile, s) 
    'call echo(logfile,"log")
    End If 

    If InStr(openWriteSystemLog, "|txt|") > 0 Then
        Call OpenConn()
		'�жϱ�����
		if instr(getHandleTableList(),"|"&  db_PREFIX & "systemlog" &"|")>0 then
			conn.Execute("insert into " & db_PREFIX & "SystemLog (tablename,msgstr,url,adminname,ip,adddatetime) values('" & tableName & "','" & msgStr & "','" & url & "','" & Session("adminusername") & "','" & ip & "','" & addDateTime & "')") 
		end if
    End If 

End Function 

%>