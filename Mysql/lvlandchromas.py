import requests
import pandas as pd

# 定义所有要请求的语言代码列表
languages = ['ar-AE', 'de-DE', 'en-US', 'es-ES', 'es-MX', 'fr-FR', 'id-ID', 'it-IT', 'ja-JP', 'ko-KR', 'pl-PL', 'pt-BR',
             'ru-RU', 'th-TH', 'tr-TR', 'vi-VN', 'zh-CN', 'zh-TW']


# 函数：从API获取数据并提取chromas和levels信息
def get_data_for_language(language):
    url = f"https://valorant-api.com/v1/weapons/skins?language={language}"
    response = requests.get(url)
    if response.status_code == 200:
        data = response.json()
        chromas_data = []
        levels_data = []
        for skin in data['data']:
            uuid = skin['uuid']
            displayName = skin['displayName']
            if 'chromas' in skin:
                for chroma in skin['chromas']:
                    chromas_data.append({
                        'uuid': uuid,
                        'displayName': displayName,
                        'displayIcon': chroma.get('displayIcon'),
                        'fullRender': chroma.get('fullRender'),
                        'streamedVideo': chroma.get('streamedVideo')
                    })
            if 'levels' in skin:
                for level in skin['levels']:
                    levels_data.append({
                        'uuid': uuid,
                        'displayName': displayName,
                        'displayIcon': level.get('displayIcon'),
                        'streamedVideo': level.get('streamedVideo')
                    })
        return chromas_data, levels_data
    else:
        print(f"请求 {url} 失败，状态码：{response.status_code}")
        return [], []

    # 分别存储chromas和levels数据的列表


all_chromas_data = []
all_levels_data = []

# 遍历所有语言代码并获取数据
for language in languages:
    chromas_data, levels_data = get_data_for_language(language)
    all_chromas_data.extend(chromas_data)
    all_levels_data.extend(levels_data)

# 将chromas数据转换为DataFrame并保存到CSV文件
df_chromas = pd.DataFrame(all_chromas_data)
df_chromas.to_csv('weapons_skins_chromas.csv', index=False, encoding='utf-8')

# 将levels数据转换为DataFrame并保存到CSV文件
df_levels = pd.DataFrame(all_levels_data)
df_levels.to_csv('weapons_skins_levels.csv', index=False, encoding='utf-8')

print("CSV文件已保存。")