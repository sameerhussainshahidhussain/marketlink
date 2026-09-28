$file = 'c:\Users\AM BUSINESS 99\Desktop\techwiz sameer\MarketLink_Documentation_With_Logo.doc'
$lines = Get-Content -Path $file -Encoding Unicode
$count = $lines.Count
Write-Output ("Total lines: " + $count)

# Find all h1 headings in updated file
for ($i = 0; $i -lt $count; $i++) {
    $line = $lines[$i]
    if ($line -match '<h1[^>]*>') {
        $text = $line -replace '<[^>]+>', ''
        $text = $text.Trim().Substring(0, [Math]::Min($text.Trim().Length, 120))
        Write-Output ($i.ToString() + " | H1: " + $text)
    }
}
