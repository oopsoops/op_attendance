You'll have to force your VB.NET and C# app to run in 32-bit mode so the ActiveX control can work.  Project + Properties, Compile tab, scroll down, Advanced Compile Options, set Target CPU to x86.
64 bit SDK register issus：
Copy all these dll. into c:\windows\syswow64 folder,
then use administrator account to run cmd.exe
enter the following command to reg the control.
cd %windir%\syswow64      [press enter]
regsvr32 zkemkeeper.dll   [press enter]
*notice:
only 64 bit OS need to do this operation!

**请在D盘建立名称为excel的文件夹，在该文件夹内建立attendance文件夹，考勤数据导出后将以导出操作时间为名在D://excel/attendance建立一个excel文件。
