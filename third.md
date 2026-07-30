
### Step 2: 啟動 v6 訓練
本專案日誌與 CSV 均有**嚴格 append-only 保護**，再次啟動會自動讀取舊有數據向下追記，絕不覆蓋：
```bash
conda activate social-rl
python main.py --batch_size 2048 --max_hours 5.0 --output_dir ./outputs --load_path ./outputs/best_model.pth
```

### Step 3: 查看結果與繪製儀表板
更新圖表（包含訓練累積時間橫軸 + 真實世界時間標註）：
```bash
python plot_results.py
```
結果會即時更新儲存至 [outputs/training_results.png](file:///c:/Users/user1/Desktop/social-rl-simulator-v1-2/outputs/training_results.png).
