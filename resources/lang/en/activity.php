<?php

/**
 * 本檔案是基於 ChatGPT 所翻譯並加以修飾
 * 包含不同活動日誌事件的所有翻譯字符串。這些應該根據事件名稱中冒號（:）前面的值進行鍵控。
 * 如果沒有冒號，它們應該位於頂層。
 */
return [
    'auth' => [
        'fail' => '登入失敗',
        'success' => '登入成功',
        'password-reset' => '重設密碼',
        'reset-password' => '請求重設密碼',
        'checkpoint' => '請求雙重驗證',
        'recovery-token' => '使用雙重驗證備份碼',
        'token' => '解決雙重驗證',
        'ip-blocked' => '封鎖了來自未列出的 IP 地址的請求: :identifier',
        'sftp' => [
            'fail' => 'SFTP 登入失敗',
        ],
    ],
    'user' => [
        'account' => [
            'email-changed' => '將電子郵件從 :old 變更為 :new',
            'password-changed' => '更改密碼',
        ],
        'api-key' => [
            'create' => '創建新的 API 金鑰 :identifier',
            'delete' => '刪除 API 金鑰 :identifier',
        ],
        'ssh-key' => [
            'create' => '將 SSH 金鑰 :fingerprint 添加到帳戶',
            'delete' => '從帳戶中刪除 SSH 金鑰 :fingerprint',
        ],
        'two-factor' => [
            'create' => '啟用雙重驗證驗證',
            'delete' => '停用雙重驗證驗證',
        ],
    ],
    'server' => [
        'reinstall' => '重新安裝伺服器',
        'console' => [
            'command' => '在控制台上輸入指令 ":command"',
        ],
        'power' => [
            'start' => '啟動伺服器',
            'stop' => '停止伺服器',
            'restart' => '重新啟動伺服器',
            'kill' => '強制關閉伺服器',
        ],
        'backup' => [
            'download' => '下載 :name 備份',
            'delete' => '刪除 :name 備份',
            'restore' => '還原 :name 備份（刪除文件： :truncate）',
            'restore-complete' => '完成還原 :name 備份',
            'restore-failed' => '無法完成還原 :name 備份',
            'start' => '開始新的備份 :name',
            'complete' => '將 :name 備份標記為完成',
            'fail' => '將 :name 備份標記為失敗',
            'lock' => '鎖定 :name 備份',
            'unlock' => '解鎖 :name 備份',
        ],
        'database' => [
            'create' => '創建新的數據庫 :name',
            'rotate-password' => '為數據庫 :name 隨機重設密碼',
            'delete' => '刪除數據庫 :name',
        ],
        'file' => [
            'compress_one' => '壓縮 :directory:file',
            'compress_other' => '壓縮 :count 個文件於 :directory',
            'read' => '查看 :file 內容',
            'copy' => '創建 :file 的副本',
            'create-directory' => '創建目錄 :directory:name',
            'decompress' => '解壓縮 :files 於 :directory',
            'delete_one' => '刪除 :directory:files.0',
            'delete_other' => '刪除 :directory 中的 :count 個文件',
            'download' => '下載 :file',
            'pull' => '從 :url 下載文件至 :directory',
            'rename_one' => '將 :directory:files.0.from 重命名為 :directory:files.0.to',
            'rename_other' => '重命名或移動 :directory 中的 :count 個文件',
            'write' => '向 :file 寫入新內容',
            'upload' => '開始文件上傳',
            'uploaded' => '上傳 :directory:file',
        ],
        'sftp' => [
            'denied' => '由於權限被阻止 SFTP 訪問',
            'create_one' => '創建 :files.0',
            'create_other' => '創建 :count 個新文件',
            'write_one' => '修改 :files.0 內容',
            'write_other' => '修改 :count 個文件的內容',
            'delete_one' => '刪除 :files.0',
            'delete_other' => '刪除 :count 個文件',
            'create-directory_one' => '創建 :files.0 目錄',
            'create-directory_other' => '創建 :count 個目錄',
            'rename_one' => '將 :files.0.from 重命名為 :files.0.to',
            'rename_other' => '重命名或移動 :count 個文件',
        ],
        'allocation' => [
            'create' => '將 :allocation 添加到伺服器',
            'notes' => '將 :allocation 的備註從 ":old" 更新為 ":new"',
            'primary' => '將 :allocation 設置為主要伺服器配置',
            'delete' => '刪除 :allocation 配置',
        ],
        'schedule' => [
            'create' => '創建 :name 排程',
            'update' => '更新 :name 排程',
            'execute' => '手動執行 :name 排程',
            'delete' => '刪除 :name 排程',
        ],
        'task' => [
            'create' => '為 :name 排程創建新的 ":action" 任務',
            'update' => '更新 :name 排程的 ":action" 任務',
            'delete' => '刪除 :name 排程的任務',
        ],
        'settings' => [
            'rename' => '將伺服器從 :old 重命名為 :new',
            'description' => '將伺服器描述從 :old 更改為 :new',
        ],
        'startup' => [
            'edit' => '將 :variable 啟動參數從 ":old" 修改為 ":new"',
            'image' => '將伺服器的 Docker 映像從 :old 更新為 :new',
        ],
        'subuser' => [
            'create' => '將 :email 添加為共同用戶',
            'update' => '更新 :email 的共同用戶權限',
            'delete' => '將 :email 從共同用戶中移除',
        ],
    ],
];
