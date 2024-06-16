import requests
import pandas as pd

# 定义所有要请求的语言代码列表
languages = ['ar-AE', 'de-DE', 'en-US', 'es-ES', 'es-MX', 'fr-FR', 'id-ID', 'it-IT', 'ja-JP', 'ko-KR', 'pl-PL', 'pt-BR',
             'ru-RU', 'th-TH', 'tr-TR', 'vi-VN', 'zh-CN', 'zh-TW']

# 初始化一个空列表来存储所有数据
all_data = []

# 遍历所有语言代码
for language in languages:
    # 构造URL
    url = f"https://valorant-api.com/v1/weapons/skins?language={language}"

    # 发送请求并获取JSON响应
    response = requests.get(url)

    # 检查请求是否成功
    if response.status_code == 200:
        data = response.json()

        # 提取当前语言版本的数据
        for skin in data['data']:
            uuid = skin['uuid']
            displayname = skin['displayName']
            displayIcon = skin.get('displayIcon')
            contentTierUuid = skin.get('contentTierUuid')
            all_data.append({
                'uuid': uuid,
                'displayname': displayname,
                'displayIcon': displayIcon,
                'contentTierUuid':contentTierUuid,
                'language': language
            })
    else:
        print(f"请求 {url} 失败，状态码：{response.status_code}")

    # 将所有数据转换为DataFrame
df = pd.DataFrame(all_data)

# 将DataFrame保存为CSV文件，使用不带BOM的utf-8编码
df.to_csv('weapons_skins_all_languages1.csv', index=False, encoding='utf-8')

print("CSV文件已保存。")