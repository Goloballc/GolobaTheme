<!-- For large screens greater than 1180px. -->
<div class="sticky top-20 flex h-max gap-8 max-1180:hidden">
    <!-- Product Image and Videos Slider -->
    

    <!-- Product Base Image and Video with Shimmer-->
    <div
        class="max-h-[610px] max-w-[560px]"
        v-show="isMediaLoading"
    >
        <div class="shimmer min-h-[607px] min-w-[560px] rounded-xl bg-zinc-200"></div>
    </div>

    <div
        class="max-h-[305px] max-w-[280px] mx-auto"
        v-show="! isMediaLoading"
    >
        <img
            class="min-w-[225px] cursor-pointer rounded-xl"
            :src="baseFile.path"
            v-if="baseFile.type == 'image'"
            alt="{{ $product->name }}"
            width="280"
            height="305"
            tabindex="0"
            @click="isImageZooming = !isImageZooming"
            @load="onMediaLoad()"
        />

        <div
            class="min-w-[450px] cursor-pointer rounded-xl"
            tabindex="0"
            v-if="baseFile.type == 'video'"
        >
            <video
                controls
                width="475"
                alt="{{ $product->name }}"
                @click="isImageZooming = !isImageZooming"
                @loadeddata="onMediaLoad()"
                :key="baseFile.path"
            >
                <source
                    :src="baseFile.path"
                    type="video/mp4"
                />
            </video>
        </div>
    </div>
</div>

