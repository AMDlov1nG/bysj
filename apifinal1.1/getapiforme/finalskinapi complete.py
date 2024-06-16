#////////////////////获取本账号今日商店刷新的内容并打印（包括皮肤名、皮肤升级、皮肤升级预览和幻彩预览）


import requests
import json

response = requests.get('https://valorant-api.com/v1/weapons/skins?language=zh-CN')
data = json.loads(response.text)
data2 = {}
#4个获取到的skin的代码
levels_uuids = ['f9fab42c-46bf-1bf0-dba5-32988be03fc2', 'a8485a93-48fa-a301-a3f2-dca0175580df', 'a7cf8684-41a0-3dd4-e30c-6f9b4b34e635', '28a7fd58-425c-6aa7-40d6-539d5fdac46c']
for i, levels_uuid in enumerate(levels_uuids):

  matched_item = None

  # 查找uuid匹配项
  for item in data['data']:
    for level in item['levels']:
      if level['uuid'] == levels_uuid:
        matched_item = item
        break

  if matched_item:

    displayName = matched_item['displayName']

    exec(f'uuid{i+1}_displayName = displayName')

    chromas = matched_item['chromas']

    chroma_num = len(chromas)


    for j in range(chroma_num):

      chroma_displayIcon = chromas[j]['displayIcon']

      exec(f'uuid{i+1}_cdisplayIcon{j+1} = chroma_displayIcon')

      try:
          matched_chroma = next(item for item in matched_item['chromas'] if
                                item['displayIcon'] == eval(f'uuid{i + 1}_cdisplayIcon{j + 1}'))
      except StopIteration:
          matched_chroma = None

      if matched_chroma:
          streamed_video = matched_chroma.get('streamedVideo')
      else:
          streamed_video = None

      if streamed_video:
          exec(f'uuid{i + 1}_ctreamedVideo{j + 1} = str(streamed_video)')
      else:
          exec(f'uuid{i + 1}_ctreamedVideo{j + 1} = None')

      # 添加levels匹配
      # 添加levels匹配
      levels = matched_item['levels']
      levels_len = len(levels)

      for k in range(1, 6):
          streamedVideo = None
          if k - 1 < levels_len:
              streamedVideo = levels[k - 1].get('streamedVideo')

          exec(f'uuid{i + 1}_levelsVideo{k} = streamedVideo')

  else:

    print(f"levels uuid {levels_uuid} not found in data")

# 输出所有uuid信息
for i in range(1, 5):

  print(f"uuid{i}_displayName: {eval(f'uuid{i}_displayName')}")

  if eval(f'uuid{i}_displayName'):

    try:
      chroma_num = len(eval(f'uuid{i}_cdisplayIcon1'))
    except:
      chroma_num = 0

    for j in range(1, 6):

      print(f"uuid{i}_cdisplayIcon{j}: ", end="")
      try:
        print(eval(f'uuid{i}_cdisplayIcon{j}'))
      except NameError:
        print("None")

      print(f"uuid{i}_ctreamedVideo{j}: ", end="")
      try:
        print(eval(f'uuid{i}_ctreamedVideo{j}'))
      except NameError:
        print("None")

    # 输出levels匹配结果
    for k in range(1,6):
      print(f"uuid{i}_levelsVideo{k}: ", end="")
      try:
        print(eval(f'uuid{i}_levelsVideo{k}'))
      except NameError:
        print("None")

  else:

    print(f"uuid{i} not found")



