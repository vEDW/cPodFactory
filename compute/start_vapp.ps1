#Create vApp
#bdereims@vmware.com

$Vc = "###VCENTER###"
$vcUser = "###VCENTER_ADMIN###"
$vcPass = '###VCENTER_PASSWD###'
$Datacenter = "###VCENTER_DATACENTER###"
$Cluster = "###VCENTER_CLUSTER###"
$cPodName = "###CPOD_NAME###"

Set-PowerCLIConfiguration -InvalidCertificateAction Ignore -Confirm:$false -DefaultVIServerMode multiple
Connect-VIServer -Server $Vc -User $vcUser -Password $vcPass

Write-Host "Starting vApp."
$Vapp = Get-VApp -Name cPod-$cPodName -Location ( Get-Cluster -Name $Cluster )
Start-VApp -Confirm:$false -VApp $Vapp

Disconnect-VIServer -Confirm:$false
