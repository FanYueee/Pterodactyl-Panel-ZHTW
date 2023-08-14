import React from 'react';
import { ServerContext } from '@/state/server';
import ScreenBlock from '@/components/elements/ScreenBlock';
import ServerInstallSvg from '@/assets/images/server_installing.svg';
import ServerErrorSvg from '@/assets/images/server_error.svg';
import ServerRestoreSvg from '@/assets/images/server_restore.svg';

export default () => {
    const status = ServerContext.useStoreState((state) => state.server.data?.status || null);
    const isTransferring = ServerContext.useStoreState((state) => state.server.data?.isTransferring || false);
    const isNodeUnderMaintenance = ServerContext.useStoreState(
        (state) => state.server.data?.isNodeUnderMaintenance || false
    );

    return status === 'installing' || status === 'install_failed' || status === 'reinstall_failed' ? (
        <ScreenBlock
            title={'正在安裝'}
            image={ServerInstallSvg}
            message={'您的伺服器正在安裝中，等待數分鐘再回來看看。'}
        />
    ) : status === 'suspended' ? (
        <ScreenBlock
            title={'停權'}
            image={ServerErrorSvg}
            message={'您的伺服器已經被停權，無法進行控制。'}
        />
    ) : isNodeUnderMaintenance ? (
        <ScreenBlock
            title={'節點維護中'}
            image={ServerErrorSvg}
            message={'您的伺服器所在節點目前維護中，無法進行控制。'}
        />
    ) : (
        <ScreenBlock
            title={isTransferring ? '轉移中' : '還原備份中'}
            image={ServerRestoreSvg}
            message={
                isTransferring
                    ? '您的伺服器正在轉移到其他節點，過一陣子再回來看看吧。'
                    : '您的伺服器正在還原備份，過一陣子再回來看看吧。'
            }
        />
    );
};
