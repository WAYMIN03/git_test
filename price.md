# Social-RL Navigation Simulator V1.2 (v6 Production Engine)

> 多智能體社交導航強化學習模擬器 — 本地執行與高級演算法進化版

本專案將 Kaggle Notebook（T4×2 GPU）重構為模組化 Python 專案，並經過 v4/v5/v6 的重大核心演算法升級，專門適配本地 **RTX 2060 (6GB VRAM)** 執行。

---

## 🚀 歷代重要版本演進 (Version Iterations)

### 🟢 v4 基礎修正版
* **Lagrangian Advantage 修正**：
  $$A_{\text{combined}} = \frac{A_{\text{reward}} - \lambda \cdot A_{\text{cost}}}{1.0 + \lambda}$$
  修正了 Policy 損失中遺漏 $\lambda$ 限制的問題，在「目標到達」與「安全防撞」間取得完美物理拉扯與動態平衡。
* **Target Value Normalization**：解決 Critic Value Loss 爆炸至 70,000+ 的致命缺陷，將其壓制於 $0.03 \sim 0.1$ 的高精確收斂狀態。

### 🔵 v5 大幅進化版 (10智能體極限關卡突破 80% 成功率)
* **時空軌跡與座標時間變化記錄器**：出錯時自動將智能體的時空軌跡 $(t, x(t), y(t), v_x(t), v_y(t))$ 記錄於 `outputs/failure_trajectories.json`。
* **5 大高級正回饋機制**：
  1. **團隊零碰撞全數通關高額獎勵 (Perfect Team Clearance)**：全隊無傷通關時給予 $+500.0$。
  2. **社交快適距離保持獎勵 (Social Comfort Space)**：保持禮讓社交距離給予 $+0.1$ /步。
  3. **車流順向協調引導 (Flow Alignment)**：順向同行給予 $+0.2$ /步。
  4. **提前主動避讓 (Proactive Dodge)**：引導提前化解衝突。
  5. **平穩巡航 (Smooth Cruise)**：高效率巡航獎勵 $+0.15$ /步。
* **里程碑成果**：在 **10 智能體極限擁擠、0.5m 目標半徑** 的 Stage 4 環境下，實測**真實累積成功率突破 80.23%**，平均通關時間縮短至 **65.7 步 (約 3.2 秒)**！

### 🟣 v6 當前升級版 (死鎖破除與主動安全)
* **死鎖檢測與側向微物理避讓 (Deadlock Detection & Perpendicular Nudging)**：當偵測到智能體速度極低（<0.15m/s）且死鎖時間超過 15 步時，施加橫向微物理 nudge 偏置力物理推離，並處以 `-0.15` 死鎖懲罰，主動打破擁擠對峙狀態。
* **鄰近他人安全巡航懲罰 (Close Neighbor Speed Penalty)**：當鄰近智能體距離小於 1.2m 時，對其速度進行平滑的高速罰分（減速安全巡航），避免高速度撞擊。
* **雙向會車協調獎勵 (Opposite Flow Passage)**：對向會車時，方向對齊相反但平行通過者給予額外加分，極大提升雙向車道人流的交會效率。

---

## 🖥️ 硬體需求

| 項目 | 最低需求 | 測試環境 |
|------|---------|---------|
| GPU | NVIDIA GPU (4 GB VRAM) | RTX 2060 (6 GB) |
| CUDA Driver | ≥ 12.1 | 12.9 |
| RAM | 16 GB | 64 GB |
| 作業系統 | Windows 10/11 / Linux | Windows 11 |

---

## 📁 專案結構

```
social-rl-simulator-v1-2/
├── src/                    # 核心模組
│   ├── __init__.py
│   ├── config.py           # 超參數與獎勵設定系統
│   ├── logger.py           # 進階訓練日誌 (Strict Append-Only 追記保護)
│   ├── utils.py            # 向量化物理工具 (TorchScript)
│   ├── environment.py      # 社交導航環境 (GPU 向量化 + v6 進階機制)
│   ├── models.py           # Transformer 策略模型 (Actor-Critic)
│   ├── algorithms.py       # GAE + Rollout Buffer + 協調器
│   ├── trainer.py          # Lagrangian PPO 訓練引擎
│   └── visualization.py    # 軌跡 GIF 動畫生成
│
├── outputs/                # 訓練輸出目錄 (文字日誌與 CSV 均有 Append-Only 保護)
├── legacy_archives/        # 歷史存檔目錄
│   └── SRC_FULL/           # 各版本原始碼與權重全備份 (src_v2 ~ src_v5)
│
├── main.py                 # 🚀 主執行進入點
├── plot_results.py         # 📊 儀表板繪圖工具 (支援訓練時間/世界時間雙軸展示)
├── environment.yml         # Conda 環境定義
├── requirements.txt        # pip 套件清單
├── setup_env.bat           # Windows 一鍵環境建立
└── README.md               # 本說明文件
```

---
