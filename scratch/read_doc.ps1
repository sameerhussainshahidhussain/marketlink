$file = 'c:\Users\AM BUSINESS 99\Desktop\techwiz sameer\MarketLink_Documentation_With_Logo.doc'
$lines = Get-Content -Path $file -Encoding Unicode

# Find the insertion point - right before SECTION 1 comment (line 2160)
# Let's read lines 2150-2162
for ($i = 2150; $i -le 2162; $i++) {
    Write-Output ($i.ToString() + " RAW: " + $lines[$i].Substring(0, [Math]::Min($lines[$i].Length, 100)))
}
