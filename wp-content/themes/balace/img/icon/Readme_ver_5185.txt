LiteManager Pro - Server.msi program component that is installed on the remote user's computer or the server (remote installation is possible).
LiteManager Pro - Viewer.msi  program component that is installed on the administrator's computer and used for controlling remote computers.

Subfolder - NOIP (ID router)
NOIP - ID router, configure private ID router (NOIP) between Viewer and Server.

Subfolder - uninstall
Uninstall_LM.exe - uninstall previous litemanager files.
Command line
Uninstall_LM.exe /server
Uninstall_LM.exe /viewer


MicrosoftProgram_Install_and_Uninstall.meta.diagcab - fixing problems with uninstallation
https://support.microsoft.com/en-us/help/17588/windows-fix-problems-that-block-programs-being-installed-or-removed


Manual installation, just copy all LM Server files
ROMServer.exe /silentinstall
ROMServer.exe /firewall
ROMServer.exe /start

Manual uninstallation
ROMServer.exe /silentuninstall