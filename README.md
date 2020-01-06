# harto-ocr
利用Azure Vision + PHP 架設的簡易+中文文檔批量識別工具。尚未完善。

## 使用說明
本程式可以架設在任何使用PHP7的伺服器上。

1. 首先，透過composer安裝相依套件：
``` 
composer install
```

2. 複製config.ini.simple，並改名為config.ini：
```
cp config.ini.sample config.ini
vi config.ini
```

3. 申請Azure Vision API，再將Endpoint和API Key輸入至config.ini
```
vision_endpoint = Your Azure Vision Endpoint
vision_key = Your Azure Vision Key
```

即可完成部署。關於如何申請Azure Vision API KEY，可參照以下教學：
https://ithelp.ithome.com.tw/articles/10202044

## 使用須知
目前僅支援簡體中文。
